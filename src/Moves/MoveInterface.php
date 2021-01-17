<?php

namespace Moves;

use Board\Board;
use Board\Position;
use Collection\PositionCollection;

interface MoveInterface
{
    /**
     * Returns collection of available positions piece is allowed to move to
     *
     * @param Board    $board
     * @param Position $position
     *
     * @return PositionCollection
     */
    public static function getAvailablePositions(Board $board, Position $position): PositionCollection;
}
