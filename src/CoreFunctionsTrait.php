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

trait CoreFunctionsTrait
{
    private static $placeholder;

    protected static function getArity(callable $function)
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

    protected static function getConstructorArity($class)
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

    protected static function _assoc($property, $value, $object)
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

    protected static function _curryN($length, callable $function, ...$initialArguments)
    {
        return count($initialArguments) >= $length && (self::$placeholder === null || ! in_array(self::$placeholder, $initialArguments, true))
            ? $function(...$initialArguments)
            : function (... $arguments) use ($length, $function, $initialArguments) {
                return self::_curryN($length, $function, ...self::resolveArguments($arguments, $initialArguments));
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
        if (method_exists($collection, 'filter')) {
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
     * @param callable                      $function
     * @param array|\Traversable|Collection $collection
     *
     * @return array|Collection
     */
    protected static function _map(callable $function, $collection)
    {
        if (method_exists($collection, 'map')) {
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
    protected static function _partialN($arity, callable $function, ... $initialArguments)
    {
        $remainingCount = $arity - count($initialArguments);
        $partial        = function (... $arguments) use ($function, $initialArguments) {
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
    protected static function _prop($name, $object)
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
     * @param bool                          $preserveKeys
     *
     * @return array|Collection
     */
    protected static function _reverse($collection)
    {
        if (method_exists($collection, 'reverse')) {
            return $collection->reverse();
        }

        $items = is_array($collection) ? $collection : self::getCollectionItems($collection);

        return array_reverse($items, true);
    }

    /**
     * @param int                           $start
     * @param int                           $end
     * @param array|\Traversable|Collection $collection
     *
     * @return array|Collection
     */
    protected static function _slice($start, $end, $collection)
    {
        if (is_array($collection)) {
            return array_slice($collection, $start, $end - $start);
        } elseif (method_exists($collection, 'slice')) {
            return $collection->slice($start, $end);
        } else {
            $i      = 0;
            $result = [];
            foreach ($collection as $item) {
                if ($i < $start) {
                } elseif ($i >= $end) {
                    return $result;
                } else {
                    $result[] = $item;
                }

                $i++;
            }

            return $result;
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
        if (method_exists($collection, 'sort')) {
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
        return count($initialArguments) >= 2 && (self::$placeholder === null || ! in_array(self::$placeholder, $initialArguments, true))
            ? $original(...$initialArguments)
            : function (...$newArguments) use ($original, $initialArguments) {
                return self::curry2($original, self::resolveArguments($newArguments, $initialArguments));
            };
    }

    protected static function curry3(callable $original, array $initialArguments)
    {
        return count($initialArguments) >= 3 && (self::$placeholder === null || ! in_array(self::$placeholder, $initialArguments, true))
            ? $original(...$initialArguments)
            : function (...$newArguments) use ($original, $initialArguments) {
                return self::curry3($original, self::resolveArguments($newArguments, $initialArguments));
            };
    }

    protected static function testSpecificationPart($name, $part, $object)
    {
        $value = Phamda::prop($name, $object);

        return is_callable($part)
            ? $part($value, $object)
            : $value === $part;
    }

    private static function getCollectionItems($collection)
    {
        $items = [];
        foreach ($collection as $key => $item) {
            $items[$key] = $item;
        }

        return $items;
    }

    private static function resolveArguments(array $arguments, array $initialArguments)
    {
        foreach ($initialArguments as $key => $argument) {
            if ($argument instanceof Placeholder) {
                if ($arguments === []) {
                    return $initialArguments;
                }

                $initialArguments[$key] = array_shift($arguments);
            }
        }

        return array_merge($initialArguments, $arguments);
    }
}
