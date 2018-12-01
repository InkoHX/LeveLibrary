<?php
/**
 * Copyright (c) 2018 InkoHX. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/InkoHX/LeveLibrary
 */

namespace InkoHX\LeveLibrary;

use InkoHX\LeveLibrary\event\level\PlayerLevelChangeEvent;
use InkoHX\LeveLibrary\event\level\PlayerLevelUpEvent;
use InkoHX\LeveLibrary\event\xp\max\PlayerAddMaxXpEvent;
use InkoHX\LeveLibrary\event\xp\max\PlayerMaxXpChangeEvent;
use InkoHX\LeveLibrary\event\xp\PlayerAddXpEvent;
use InkoHX\LeveLibrary\event\xp\PlayerXpChangeEvent;
use pocketmine\Player;
use pocketmine\Server;

class LevelAPI
{
    /** @var string $path */
    private static $path;

    /**
     * @return void
     */
    public static function init(): void
    {
        self::$path = Server::getInstance()->getDataPath().'/Library/LeveLibrary/';
    }

    public static function Auto(Player $player, $xp = 10, $max = 50)
    {
        if (self::getXP($player) >= self::getMaxXP($player)) {
            self::addMaxXP($player, $max);
            self::addLevel($player, 1);
            self::setXP($player, 0);
        } else {
            self::addXP($player, $xp);
        }
    }

    /**
     * @param Player $player
     * @param int    $level
     *
     * @return void
     */
    public static function setLevel(Player $player, int $level): void
    {
        $event = new PlayerLevelChangeEvent($player, self::getLevel($player), $level);
        Server::getInstance()->getPluginManager()->callEvent($event);
        if (!$event->isCancelled()) {
            $db = new DataFile($player->getXuid());
            $db->set('level', $event->getNewLevel());
        }
    }

    /**
     * @param Player $player
     * @param int    $level
     *
     * @return void
     */
    public static function addLevel(Player $player, int $level): void
    {
        $event = new PlayerLevelUpEvent($player, self::getLevel($player), $level + self::getLevel($player));
        Server::getInstance()->getPluginManager()->callEvent($event);
        if (!$event->isCancelled()) {
            $db = new DataFile($player->getXuid());
            $db->set('level', self::getLevel($player) + $event->getNewLevel());
        }
    }

    /**
     * @param Player $player
     *
     * @return int
     */
    public static function getLevel(Player $player): int
    {
        $db = new DataFile($player->getXuid());

        return $db->get('level');
    }

    /**
     * @param Player $player
     * @param int    $xp
     *
     * @return void
     */
    public static function setXP(Player $player, int $xp): void
    {
        $event = new PlayerXpChangeEvent($player, self::getXP($player), $xp);
        Server::getInstance()->getPluginManager()->callEvent($event);
        if (!$event->isCancelled()) {
            $db = new DataFile($player->getXuid());
            $db->set('xp', $event->getNewXp());
        }
    }

    /**
     * @param Player $player
     * @param int    $xp
     *
     * @return void
     */
    public static function addXP(Player $player, int $xp): void
    {
        $event = new PlayerAddXpEvent($player, $xp);
        Server::getInstance()->getPluginManager()->callEvent($event);
        if (!$event->isCancelled()) {
            $db = new DataFile($player->getXuid());
            $db->set('xp', self::getXP($player) + $event->getXp());
        }
    }

    /**
     * @param Player $player
     *
     * @return int
     */
    public static function getXP(Player $player): int
    {
        $db = new DataFile($player->getXuid());

        return $db->get('xp');
    }

    /**
     * @param Player $player
     * @param int    $max
     *
     * @return void
     */
    public static function setMaxXP(Player $player, int $max): void
    {
        $event = new PlayerMaxXpChangeEvent($player, self::getMaxXP($player), $max);
        Server::getInstance()->getPluginManager()->callEvent($event);
        if (!$event->isCancelled()) {
            $db = new DataFile($player->getXuid());
            $db->set('maxxp', $event->getNewMax());
        }
    }

    /**
     * @param Player $player
     * @param int    $max
     *
     * @return void
     */
    public static function addMaxXP(Player $player, int $max): void
    {
        $event = new PlayerAddMaxXpEvent($player, $max);
        Server::getInstance()->getPluginManager()->callEvent($event);
        if (!$event->isCancelled()) {
            $db = new DataFile($player->getXuid());
            $db->set('maxxp', self::getMaxXP($player) + $event->getMax());
        }
    }

    /**
     * @param Player $player
     *
     * @return int
     */
    public static function getMaxXP(Player $player): int
    {
        $db = new DataFile($player->getXuid());

        return $db->get('maxxp');
    }

    /**
     * @param Player $player
     *
     * @return int
     */
    public static function NeededXP(Player $player): int
    {
        return self::getMaxXP($player) - self::getXP($player);
    }

    /**
     * @return string
     */
    public static function getPath(): string
    {
        return self::$path;
    }
}
