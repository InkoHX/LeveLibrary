<?php
/**
 * Copyright (c) 2018 InkoHX. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/InkoHX/LeveLibrary
 */

namespace InkoHX\LeveLibrary\event\xp\max;

use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class PlayerAddMaxXpEvent extends PlayerEvent implements Cancellable
{
    /** @var int $max */
    private $max;

    /**
     * PlayerAddMaxXpEvent constructor.
     *
     * @param Player $player
     * @param int    $max
     */
    public function __construct(Player $player, int $max)
    {
        $this->player = $player;
        $this->max = $max;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param int $max
     *
     * @return void
     */
    public function setMax(int $max): void
    {
        $this->max = $max;
    }
}
