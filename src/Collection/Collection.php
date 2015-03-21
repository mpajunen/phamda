<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\Collection;

/**
 * Collection interface includes the collection object methods directly supported in Phamda
 *
 * Mostly based on \Doctrine\Common\Collections\Collection
 *
 * @internal This interface is only intended for type hints and tests.
 */
interface Collection
{
    /**
     * @param mixed $item
     *
     * @return Collection
     */
    public function append($item);

    /**
     * @param mixed $item
     *
     * @return bool
     */
    public function contains($item);

    /**
     * @param callable $predicate
     *
     * @return Collection
     */
    public function filter(callable $predicate);

    /**
     * @param callable $function
     *
     * @return Collection
     */
    public function map(callable $function);

    /**
     * @return mixed
     */
    public function first();

    /**
     * @param callable $function
     *
     * @return Collection[]
     */
    public function groupBy(callable $function);

    /**
     * @param $item
     *
     * @return int|false
     */
    public function indexOf($item);

    /**
     * @return bool
     */
    public function isEmpty();

    /**
     * @return mixed
     */
    public function last();

    /**
     * @param callable $predicate
     *
     * @return Collection[]
     */
    public function partition(callable $predicate);

    /**
     * @param mixed $item
     *
     * @return Collection
     */
    public function prepend($item);

    /**
     * @param bool $preserveKeys
     *
     * @return Collection
     */
    public function reverse($preserveKeys = false);

    /**
     * @param int $start
     * @param int $end
     *
     * @return Collection
     */
    public function slice($start, $end);

    /**
     * @param callable $comparator
     *
     * @return Collection
     */
    public function sort(callable $comparator);
}
