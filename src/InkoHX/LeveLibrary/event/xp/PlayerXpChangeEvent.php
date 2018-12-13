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

class PlayerXpChangeEvent extends PlayerEvent implements Cancellable
{
    /** @var int $newXp */
    private $newXp;

    /** @var int $oldXp */
    private $oldXp;

    /**
     * PlayerXpChangeEvent constructor.
     *
     * @param Player $player
     * @param int $oldXp
     * @param int $newXp
     */
    public function __construct(Player $player, int $oldXp, int $newXp)
    {
        $this->player = $player;
        $this->oldXp = $oldXp;
        $this->newXp = $newXp;
    }

    /**
     * @return int
     */
    public function getOldXp(): int
    {
        return $this->oldXp;
    }

    /**
     * @return int
     */
    public function getNewXp(): int
    {
        return $this->newXp;
    }

    /**
     * @param int $newXp
     *
     * @return void
     */
    public function setNewXp(int $newXp): void
    {
        $this->newXp = $newXp;
    }
}
