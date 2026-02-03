<?php
namespace SoampliApps\Core;

abstract class AbstractCollection implements \Countable, \IteratorAggregate
{
    protected $objects = array();

    public function add($object)
    {
        $this->objects[] = $object;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->objects);
    }

    public function count(): int 
    {
        return count($this->objects);
    }

    public function pop(): mixed
    {
        return $this->objects[count($this->objects)-1];
    }

}
