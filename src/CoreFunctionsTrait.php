<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda;

use Phamda\Collection\Collection;

/**
 * Internal and helper functions for the public functions.
 */
trait CoreFunctionsTrait
{
    protected static function getArity(callable $function): int
    {
        if (is_string($function) || $function instanceof \Closure) {
            $reflection = new \ReflectionFunction($function);
        } elseif (is_array($function)) {
            list($class, $name) = $function;

            $reflection = new \ReflectionMethod($class, $name);
        } else {
            $reflectionObject = new \ReflectionObject($function);
            $reflection       = $reflectionObject->getMethod('__invoke');
        }

        return $reflection->getNumberOfRequiredParameters();
    }

    protected static function getConstructorArity(string $class): int
    {
        return (new \ReflectionClass($class))
            ->getConstructor()
            ->getNumberOfRequiredParameters();
    }

    /**
     * @param callable           $comparator
     * @param callable           $getValue
     * @param array|\Traversable $collection
     *
     * @return mixed
     */
    protected static function getCompareByResult(callable $comparator, callable $getValue, $collection)
    {
        $comparison = null;
        $result     = null;

        foreach ($collection as $item) {
            $value = $getValue($item);
            if ($comparison === null || $comparator($value, $comparison)) {
                $comparison = $value;
                $result     = $item;
            }
        }

        return $result;
    }

    /**
     * @param callable           $comparator
     * @param array|\Traversable $collection
     *
     * @return mixed
     */
    protected static function getCompareResult(callable $comparator, $collection)
    {
        $result = null;

        foreach ($collection as $item) {
            if ($result === null || $comparator($item, $result)) {
                $result = $item;
            }
        }

        return $result;
    }

    protected static function _assoc(string $property, $value, $object)
    {
        if (is_object($object)) {
            $object            = clone $object;
            $object->$property = $value;
        } else {
            $object[$property] = $value;
        }

        return $object;
    }

    protected static function _assocPath(array $path, $value, $object)
    {
        $property = $path[0];

        if (count($path) > 1) {
            if (is_object($object)) {
                $object            = clone $object;
                $object->$property = static::_assocPath(array_slice($path, 1), $value, $object->$property);
            } else {
                $object[$property] = static::_assocPath(array_slice($path, 1), $value, $object[$property]);
            }
        } else {
            $object = static::_assoc($property, $value, $object);
        }

        return $object;
    }

    protected static function _curryN(int $length, callable $function, ...$initialArguments)
    {
        return count($initialArguments) >= $length
            ? $function(...$initialArguments)
            : function (...$arguments) use ($length, $function, $initialArguments) {
                return self::_curryN($length, $function, ...array_merge($initialArguments, $arguments));
            };
    }

    /**
     * @param callable                      $predicate
     * @param array|\Traversable|Collection $collection
     *
     * @return array|Collection
     */
    protected static function _filter(callable $predicate, $collection)
    {
        if (! is_array($collection) && method_exists($collection, 'filter')) {
            return $collection->filter($predicate);
        }

        $result = [];
        foreach ($collection as $key => $item) {
            if ($predicate($item, $key, $collection)) {
                $result[$key] = $item;
            }
        }

        return $result;
    }

    /**
     * @param array $list
     * @param bool  $recursive
     *
     * @return array
     */
    protected static function _flatten(array $list, bool $recursive): array
    {
        $result = [];
        foreach ($list as $item) {
            if (is_array($item)) {
                $result = array_merge($result, $recursive ? self::_flatten($item, $recursive) : $item);
            } else {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @param callable                      $function
     * @param array|\Traversable|Collection $collection
     *
     * @return array|Collection
     */
    protected static function _map(callable $function, $collection)
    {
        if (! is_array($collection) && method_exists($collection, 'map')) {
            return $collection->map($function);
        }

        $result = [];
        foreach ($collection as $key => $item) {
            $result[$key] = $function($item, $key, $collection);
        }

        return $result;
    }

    /**
     * @param int      $arity
     * @param callable $function
     * @param mixed    ...$initialArguments
     *
     * @return callable
     */
    protected static function _partialN(int $arity, callable $function, ...$initialArguments): callable
    {
        $remainingCount = $arity - count($initialArguments);
        $partial        = function (...$arguments) use ($function, $initialArguments) {
            return $function(...array_merge($initialArguments, $arguments));
        };

        return $remainingCount > 0 ? static::_curryN($remainingCount, $partial) : $partial;
    }

    /**
     * @param string                    $name
     * @param array|object|\ArrayAccess $object
     *
     * @return mixed
     */
    protected static function _prop(string $name, $object)
    {
        return is_array($object) || $object instanceof \ArrayAccess ? $object[$name] : $object->$name;
    }

    /**
     * @param callable           $function
     * @param mixed              $initial
     * @param array|\Traversable $collection
     *
     * @return mixed
     */
    protected static function _reduce(callable $function, $initial, $collection)
    {
        foreach ($collection as $key => $item) {
            $initial = $function($initial, $item, $key, $collection);
        }

        return $initial;
    }

    /**
     * @param array|\Traversable|Collection $collection
     *
     * @return array|Collection
     */
    protected static function _reverse($collection)
    {
        if (! is_array($collection) && method_exists($collection, 'reverse')) {
            return $collection->reverse();
        }

        $items = is_array($collection) ? $collection : self::getCollectionItems($collection);

        return array_reverse($items, true);
    }

    /**
     * @param int                           $start
     * @param int|null                      $end
     * @param array|\Traversable|Collection $collection
     *
     * @return array|Collection
     */
    protected static function _slice(int $start, int $end = null, $collection)
    {
        if (is_array($collection)) {
            return array_slice($collection, $start, $end !== null && $end >= 0 ? $end - $start : $end);
        } elseif (method_exists($collection, 'slice')) {
            return $collection->slice($start, $end);
        } else {
            $i      = 0;
            $result = [];
            foreach ($collection as $item) {
                if ($start >= 0 && $i < $start) {
                } elseif ($end !== null && $end >= 0 && $i >= $end) {
                    return $result;
                } else {
                    $result[] = $item;
                }

                ++$i;
            }

            return array_slice($result, $start < 0 ? $start : 0, $end !== null && $end < 0 ? $end : null);
        }
    }

    /**
     * @param callable                      $comparator
     * @param array|\Traversable|Collection $collection
     *
     * @return array|Collection
     */
    protected static function _sort(callable $comparator, $collection)
    {
        if (! is_array($collection) && method_exists($collection, 'sort')) {
            return $collection->sort($comparator);
        } elseif (! is_array($collection)) {
            $items = [];
            foreach ($collection as $key => $item) {
                $items[$key] = $item;
            }

            $collection = $items;
        }

        usort($collection, $comparator);

        return $collection;
    }

    protected static function curry1(callable $original, array $initialArguments)
    {
        return count($initialArguments) === 0 ? $original : $original(...$initialArguments);
    }

    protected static function curry2(callable $original, array $initialArguments)
    {
        return count($initialArguments) >= 2
            ? $original(...$initialArguments)
            : function (...$newArguments) use ($original, $initialArguments) {
                return self::curry2($original, array_merge($initialArguments, $newArguments));
            };
    }

    protected static function curry3(callable $original, array $initialArguments)
    {
        return count($initialArguments) >= 3
            ? $original(...$initialArguments)
            : function (...$newArguments) use ($original, $initialArguments) {
                return self::curry3($original, array_merge($initialArguments, $newArguments));
            };
    }

    protected static function testSpecificationPart(string $name, $part, $object)
    {
        $value = self::_prop($name, $object);

        return is_callable($part)
            ? $part($value, $object)
            : $value === $part;
    }

    private static function getCollectionItems($collection): array
    {
        $items = [];
        foreach ($collection as $key => $item) {
            $items[$key] = $item;
        }

        return $items;
    }
}
