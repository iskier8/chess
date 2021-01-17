<?php

namespace Piece;

use Moves\OneSquareForwardMove;
use Moves\TwoSquaresForwardMove;

class Pawn extends AbstractPiece
{
    protected array $availableMoves = [
        OneSquareForwardMove::class,
        TwoSquaresForwardMove::class,
        /**
         * TODO:
         * - Capture move
         * - En passant
         * - Back rank promotion
         */
    ];
}