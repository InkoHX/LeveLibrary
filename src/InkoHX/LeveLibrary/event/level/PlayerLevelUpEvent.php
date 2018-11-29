<?php
/**
 * Copyright (c) 2018 InkoHX. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/InkoHX/LeveLibrary
 */

namespace InkoHX\LeveLibrary\event\level;


use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class PlayerLevelUpEvent extends PlayerEvent implements Cancellable
{
    /** @var int $level */
    private $oldLevel;

    /** @var int $newLevel */
    private $newLevel;

    /**
     * PlayerLevelUpEvent constructor.
     *
     * @param Player $player
     * @param int $oldLevel
     * @param int $newLevel
     */
    public function __construct(Player $player, int $oldLevel, int $newLevel)
    {
        $this->player = $player;
        $this->oldLevel = $oldLevel;
        $this->newLevel = $newLevel;
    }

    /**
     * @return int
     */
    public function getOldLevel(): int
    {
        return $this->oldLevel;
    }

    /**
     * @return int
     */
    public function getNewLevel(): int
    {
        return $this->newLevel;
    }

    /**
     * @param int $newLevel
     *
     * @return void
     */
    public function setNewLevel(int $newLevel): void
    {
        $this->newLevel = $newLevel;
    }
}