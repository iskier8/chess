<?php

namespace Piece;

use Board\Board;
use Board\Position;
use Collection\PositionCollection;
use Board\Side;
use Moves\MoveInterface;

abstract class AbstractPiece
{
    protected Side $side;

    /**
     * @var MoveInterface[] $availableMoves
     */
    protected array $availableMoves = [];

    public function __construct(Side $side)
    {
        $this->side = $side;
    }

    /**
     * Return array of Position objects of available moves
     *
     * @param Board    $board
     * @param Position $position
     *
     * @return PositionCollection
     */
    function getAvailableMoves(Board $board, Position $position): PositionCollection
    {
        $allMovesPositions = new PositionCollection();

        foreach ($this->availableMoves as $moveClassName)
        {
            $positions = call_user_func_array([$moveClassName, 'getAvailablePositions'], [$board, $position, $this]);
            $allMovesPositions->mergeWith($positions);
        }

        return $allMovesPositions;
    }

    /**
     * @return Side
     */
    public function getSide(): Side
    {
        return $this->side;
    }
}