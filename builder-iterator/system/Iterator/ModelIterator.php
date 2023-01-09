<?php

namespace System\Iterator;

class ModelIterator implements \Iterator
{
    private int $position;

    public function __construct(private $array = [])
    {
        $this->position = 0;
    }

    public function current(): string|array
    {
        $myArray = $this->array;
        array_walk_recursive(
            $myArray,
            function (&$value) {
                if (!is_array($value)) {
                    $value = 'Q'.$value;
                }
            }
        );

        return $myArray[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position += 1;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->array[$this->position]);
    }
}