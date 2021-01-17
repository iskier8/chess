<?php

namespace Piece;

use Moves\DiagonalMove;

class Bishop extends AbstractPiece
{
    protected array $availableMoves = [
        DiagonalMove::class,
    ];
}