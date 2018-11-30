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

class PlayerMaxXpChangeEvent extends PlayerEvent implements Cancellable
{
    /** @var int $newMax */
    private $newMax;

    /** @var int $oldMax */
    private $oldMax;

    /**
     * PlayerMaxXpChangeEvent constructor.
     *
     * @param Player $player
     * @param int    $oldMax
     * @param int    $newMax
     */
    public function __construct(Player $player, int $oldMax, int $newMax)
    {
        $this->player = $player;
        $this->oldMax = $oldMax;
        $this->newMax = $newMax;
    }

    /**
     * @return int
     */
    public function getOldMax(): int
    {
        return $this->oldMax;
    }

    /**
     * @return int
     */
    public function getNewMax(): int
    {
        return $this->newMax;
    }

    /**
     * @param int $newMax
     *
     * @return void
     */
    public function setNewMax(int $newMax): void
    {
        $this->newMax = $newMax;
    }
}
