<?php

namespace Collection;

use Board\Board;
use Board\Position;

class PositionCollection
{
    /**
     * @var Position[] $items
     */
    protected array $items = [];

    /**
     * @param Position $position
     */
    public function addItem(Position $position)
    {
        $this->items[$position->getSquareName()] = $position;
    }

    /**
     * Clears collection
     */
    public function clear()
    {
        $this->items = [];
    }

    /**
     * @return array|Position[]
     */
    public function asArray(): array
    {
        return $this->items;
    }

    /**
     * Merges given PositionCollection to self
     *
     * @param PositionCollection $collection
     */
    public function mergeWith(PositionCollection $collection)
    {
        $this->items = array_merge($this->asArray(), $collection->asArray());
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return implode(', ', array_keys($this->items));
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return !count($this->items);
    }
}
