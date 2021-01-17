<?php

namespace Moves;

use Board\Board;
use Board\Position;
use Collection\PositionCollection;

class DiagonalMove implements MoveInterface
{
    const DIRECTION_FROM_LEFT_BOTTOM = 1;
    const DIRECTION_FROM_LEFT_TOP    = -1;

    /**
     * Returns available positions of diagonal move
     *
     * @param Board    $board
     * @param Position $position
     *
     * @return PositionCollection
     */
    public static function getAvailablePositions(Board $board, Position $position): PositionCollection
    {
        $availableMovesPositions = new PositionCollection();

        $availableMovesPositions->mergeWith(
            self::getDiagonalDirectionMoves($board, $position, static::DIRECTION_FROM_LEFT_BOTTOM)
        );
        $availableMovesPositions->mergeWith(
            self::getDiagonalDirectionMoves($board, $position, static::DIRECTION_FROM_LEFT_TOP)
        );

        return $availableMovesPositions;
    }

    /**
     * Checks one direction of diagonal move
     *
     * Checks cross move from left to right starting from direction top or bottom.
     * Does not collect positions which needs jump over existing piece.
     *
     * @param Board    $board
     * @param Position $position
     * @param int      $direction
     *
     * @return PositionCollection
     */
    protected static function getDiagonalDirectionMoves(Board $board, Position $position, int $direction): PositionCollection
    {
        $availableMovesPositions = new PositionCollection();

        $piece = $board->getSquare($position)->getPiece();

        for ($i = 1; $i <= $board->getCols(); $i++) {
            $distanceX    = $i - $position->getCol();
            $movePosition = new Position(
                $position->getCol() + $distanceX,
                $position->getRow() + $direction * $distanceX
            );

            // Don't check rest if we get out of bounds of the board
            if (empty($board->getSquare($movePosition))) {
                continue;
            }

            if ($i < $position->getCol() && !$board->getSquare($movePosition)->isEmpty()) {
                // Clearing moves that need jump over as it is not allowed
                $availableMovesPositions->clear();

                // Capturing piece move
                if (!$board->getSquare($movePosition)->hasSameSidePiece($piece)) {
                    $availableMovesPositions->addItem($movePosition);
                }
            } else if ($i > $position->getCol() && !$board->getSquare($movePosition)->isEmpty()) {
                // Stop collecting moves when we find something on our way - jump over not allowed

                // Capturing piece move
                if (!$board->getSquare($movePosition)->hasSameSidePiece($piece)) {
                    $availableMovesPositions->addItem($movePosition);
                }

                break;
            }

            if ($board->getSquare($movePosition)->isEmpty()) {
                $availableMovesPositions->addItem($movePosition);
            }
        }

        return $availableMovesPositions;
    }
}
