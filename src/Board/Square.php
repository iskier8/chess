<?php

namespace Board;

use Piece\AbstractPiece;

class Square
{
    protected Position $position;

    protected ?AbstractPiece $piece = null;

    /**
     * @param $position
     */
    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    /**
     * @return Position
     */
    public function getPosition(): Position
    {
        return $this->position;
    }

    /**
     * @return AbstractPiece|null
     */
    public function getPiece(): ?AbstractPiece
    {
        return $this->piece;
    }

    /**
     * @param AbstractPiece|null $piece
     */
    public function setPiece(?AbstractPiece $piece): void
    {
        $this->piece = $piece;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return !$this->getPiece();
    }

    /**
     * Returns if on this square is piece of same side
     *
     * @param AbstractPiece $piece
     *
     * @return bool
     */
    public function hasSameSidePiece(AbstractPiece $piece)
    {
        if ($this->isEmpty()) {
            return false;
        }
        return $this->getPiece()->getSide() === $piece->getSide();
    }
}
