<?php

namespace Board;

class Side
{
    const COLOR_WHITE = 'white';
    const COLOR_BLACK = 'black';

    const DIR_UP   = +1;
    const DIR_DOWN = -1;

    protected string $color;

    protected int $direction;

    /**
     * @param string $color
     * @param int    $direction
     */
    public function __construct(string $color, int $direction)
    {
        $this->color     = $color;
        $this->direction = $direction;
    }

    /**
     * @return int
     */
    public function getDirection(): int
    {
        return $this->direction;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }
}
