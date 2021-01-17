<?php

namespace Moves;

use Board\Board;
use Board\Position;
use Collection\PositionCollection;

class TwoSquaresForwardMove implements MoveInterface
{
    /**
     * Returns available positions of two square forward move
     *
     * Move allows to move piece exact two square only in forward direction.
     * Move have to be done from starting position.
     * You can not jump over another piece.
     *
     * @param Board    $board
     * @param Position $position
     *
     * @return PositionCollection
     */
    public static function getAvailablePositions(Board $board, Position $position): PositionCollection
    {
        $availableMovesPositions = new PositionCollection();

        // Jumping over is not allowed
        if (OneSquareForwardMove::getAvailablePositions($board, $position)->isEmpty()) {
            return $availableMovesPositions;
        }

        $piece = $board->getSquare($position)->getPiece();

        if ($position->getRow() === 2 || $position->getRow() === $board->getRows() - 1) {
            $twoForward = new Position(
                $position->getCol(),
                $position->getRow() + $piece->getSide()->getDirection() * 2
            );

            if ($board->getSquare($twoForward) /** TODO **/) {
                $availableMovesPositions->addItem($twoForward);
            }
        }

        return $availableMovesPositions;
    }
}
