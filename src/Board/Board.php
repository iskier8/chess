<?php

namespace Board;

use Collection\PositionCollection;
use Exception;
use Piece\AbstractPiece;

class Board
{
    const ERR_SQUARE_DID_NOT_EXIST                 = 'Square did not exist.';
    const ERR_NO_PIECE_IS_ON_THE_SQUARE            = 'No piece is on the square.';
    const ERR_THERE_IS_ALREADY_A_PIECE_ON_A_SQUARE = 'There is already a piece on a square.';

    protected array $squares;

    protected int $cols;

    protected int $rows;

    /**
     * @param int $cols
     * @param int $rows
     */
    public function __construct(int $cols, int $rows)
    {
        $this->cols = $cols;
        $this->rows = $rows;
        $this->initialise();
    }

    /**
     * Initialisation of board
     *
     * Creating table of rows where A=1, B=2...
     * having columns from n-1 in descending order
     */
    protected function initialise()
    {
        // Columns: A = 1 to ...
        for ($c = 1; $c <= $this->getCols(); $c++) {
            // Columns: n to 1 in descending order
            for ($r = $this->getRows(); $r >= 1; $r--) {
                $this->squares[$c][$r] = new Square(new Position($c, $r));
            }
        }
    }

    /**
     * @return int
     */
    public function getCols(): int
    {
        return $this->cols;
    }

    /**
     * @return int
     */
    public function getRows(): int
    {
        return $this->rows;
    }

    /**
     * @param Position $position
     *
     * @return Square|null
     */
    public function getSquare(Position $position): ?Square
    {
        return $this->squares[$position->getCol()][$position->getRow()] ?? null;
    }

    /**
     * @param AbstractPiece $piece
     * @param Position      $position
     *
     * @throws Exception
     */
    public function addPiece(AbstractPiece $piece, Position $position)
    {
        $square = $this->getSquare($position);

        if (empty($square)) {
            throw new Exception(self::ERR_SQUARE_DID_NOT_EXIST);
        }

        if ($square->getPiece()) {
            throw new Exception(self::ERR_THERE_IS_ALREADY_A_PIECE_ON_A_SQUARE);
        }

        $square->setPiece($piece);
    }

    /**
     * Return collection of available moves of piece on given position on a board
     *
     * @param Position $position
     *
     * @return PositionCollection Positions collection of available moves
     *
     * @throws Exception
     */
    public function getPieceAvailableMoves(Position $position): PositionCollection
    {
        $square = $this->getSquare($position);
        if (empty($square)) {
            throw new Exception(self::ERR_SQUARE_DID_NOT_EXIST);
        }

        $piece = $square->getPiece();
        if (empty($piece)) {
            throw new Exception(self::ERR_NO_PIECE_IS_ON_THE_SQUARE);
        }

        return $piece->getAvailableMoves($this, $position);
    }

    /**
     * Returns array of squares having piece
     *
     * @return Square[]
     */
    public function getNonEmptySquares(): array
    {
        $nonEmptySquares = [];

        foreach ($this->squares as $cols) {
            /**
             * @var Square $square
             */
            foreach ($cols as $square) {
                if (!$square->isEmpty()) {
                    $nonEmptySquares[] = $square;
                }
            }
        }

        return $nonEmptySquares;
    }
}
