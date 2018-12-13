<?php
/**
 * Copyright (c) 2018 InkoHX. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/InkoHX/LeveLibrary
 */

namespace InkoHX\LeveLibrary\event\xp;

use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class PlayerAddXpEvent extends PlayerEvent implements Cancellable
{
    /** @var int $xp */
    private $xp;

    /**
     * PlayerAddXpEvent constructor.
     *
     * @param Player $player
     * @param int    $xp
     */
    public function __construct(Player $player, int $xp)
    {
        $this->player = $player;
        $this->xp = $xp;
    }

    /**
     * @return int
     */
    public function getXp(): int
    {
        return $this->xp;
    }

    /**
     * @param int $xp
     *
     * @return void
     */
    public function setXp(int $xp): void
    {
        $this->xp = $xp;
    }
}
