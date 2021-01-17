<?php

namespace Board;

class Position
{
    protected int $col;
    protected int $row;

    /**
     * @param $col
     * @param $row
     */
    public function __construct($col, $row)
    {
        $this->col = $col;
        $this->row = $row;
    }

    /**
     * Creates position object by translating from chess field name string
     *
     * Changes f. ex. B3 to Position where X=2 and Y=3
     *
     * @param string $squareName
     *
     * @return static
     */
    public static function get(string $squareName): self
    {
        [$colLetter, $rowNumber] = str_split($squareName);
        $colNumber = ord(strtolower($colLetter)) - 96;

        return new static($colNumber, $rowNumber);
    }

    /**
     * Translates back Position to chess field name string
     *
     * @return string
     */
    public function getSquareName(): string
    {
        $colLetter = strtoupper(chr($this->getCol() + 96));

        return $colLetter . $this->getRow();
    }

    /**
     * @return int
     */
    public function getCol(): int
    {
        return $this->col;
    }

    /**
     * @return int
     */
    public function getRow(): int
    {
        return $this->row;
    }
}
