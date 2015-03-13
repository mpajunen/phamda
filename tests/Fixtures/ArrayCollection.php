<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\Tests\Fixtures;

use Phamda\Collection\Collection;

class ArrayCollection implements Collection, \ArrayAccess, \Countable, \IteratorAggregate
{
    /** @var mixed[] */
    private $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @param mixed $item
     *
     * @return bool
     */
    public function contains($item)
    {
        return in_array($item, $this->values, true);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->values);
    }

    /**
     * @param callable $predicate
     *
     * @return static
     */
    public function filter(callable $predicate)
    {
        $values = [];
        foreach ($this->values as $key => $item) {
            if ($predicate($item, $key, $this)) {
                $values[$key] = $item;
            }
        }

        return new static($values);
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return reset($this->values);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->values);
    }

    /**
     * @param callable $function
     *
     * @return static[]
     */
    public function groupBy(callable $function)
    {
        $groups = [];
        foreach ($this->values as $key => $item) {
            $groups[$function($item, $key, $this)][] = $item;
        }

        return array_map(function (array $group) {
            return new static($group);
        }, $groups);
    }

    /**
     * @param $item
     *
     * @return int|false
     */
    public function indexOf($item)
    {
        return array_search($item, $this->values, true);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->values);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->values);
    }

    /**
     * @param callable $function
     *
     * @return static
     */
    public function map(callable $function)
    {
        $values = [];
        foreach ($this->values as $key => $item) {
            $values[$key] = $function($item, $key, $this);
        }

        return new static($values);
    }

    /**
     * @param int|string $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->values);
    }

    /**
     * @param int|string $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->values[$offset];
    }

    /**
     * @param int|string $offset
     * @param mixed      $value
     */
    public function offsetSet($offset, $value)
    {
        $this->values[$offset] = $value;
    }

    /**
     * @param int|string $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }

    /**
     * @param callable $predicate
     *
     * @return static[]
     */
    public function partition(callable $predicate)
    {
        $groups = [[], []];
        foreach ($this->values as $key => $item) {
            $groups[$predicate($item, $key, $this) ? 0 : 1][] = $item;
        }

        return array_map(function (array $group) {
            return new static($group);
        }, $groups);
    }

    /**
     * @return static
     */
    public function reverse()
    {
        return new static(array_reverse($this->values));
    }

    /**
     * @param int $start
     * @param int $end
     *
     * @return Collection
     */
    public function slice($start, $end)
    {
        return new static(array_slice($this->values, $start, $end - $start));
    }

    /**
     * @param callable $comparator
     *
     * @return static
     */
    public function sort(callable $comparator)
    {
        $values = $this->values;
        usort($values, $comparator);

        return new static($values);
    }

    /**
     * @return \mixed[]
     */
    public function toArray()
    {
        return $this->values;
    }
}