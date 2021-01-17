<?php

namespace Moves;

use Board\Board;
use Board\Position;
use Collection\PositionCollection;

class OneSquareForwardMove implements MoveInterface
{
    /**
     * Returns available positions of one square forward move
     *
     * Move allows to move piece only one square only in forward direction
     *
     * @param Board    $board
     * @param Position $position
     *
     * @return PositionCollection
     */
    public static function getAvailablePositions(Board $board, Position $position): PositionCollection
    {
        $availableMovesPositions = new PositionCollection();

        $piece = $board->getSquare($position)->getPiece();

        $oneForwardPosition = new Position(
            $position->getCol(),
            $position->getRow() + $piece->getSide()->getDirection() * 1
        );

        if ($board->getSquare($oneForwardPosition) && $board->getSquare($oneForwardPosition)->isEmpty()) {
            $availableMovesPositions->addItem($oneForwardPosition);
        }

        return $availableMovesPositions;
    }
}
