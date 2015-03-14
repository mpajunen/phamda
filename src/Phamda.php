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
use Phamda\Exception\InvalidFunctionCompositionException;

class Phamda
{
    use CoreFunctionsTrait;

    /**
     * @param int|float $x
     * @param int|float $y
     *
     * @return callable|int|float
     */
    public static function add($x = null, $y = null)
    {
        return static::curry2(function ($x, $y) {
            return $x + $y;
        }, func_get_args());
    }

    /**
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|bool
     */
    public static function all(callable $predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            foreach ($collection as $item) {
                if (! $predicate($item)) {
                    return false;
                }
            }

            return true;
        }, func_get_args());
    }

    /**
     * @param callable[] $predicates
     *
     * @return callable
     */
    public static function allPass(array $predicates = null)
    {
        return static::curry1(function (array $predicates) {
            return function (... $arguments) use ($predicates) {
                foreach ($predicates as $predicate) {
                    if (! $predicate(...$arguments)) {
                        return false;
                    }
                }

                return true;
            };
        }, func_get_args());
    }

    /**
     * @param mixed $value
     *
     * @return callable
     */
    public static function always($value)
    {
        return function () use ($value) {
            return $value;
        };
    }

    /**
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|bool
     */
    public static function any(callable $predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            foreach ($collection as $item) {
                if ($predicate($item)) {
                    return true;
                }
            }

            return false;
        }, func_get_args());
    }

    /**
     * @param callable[] $predicates
     *
     * @return callable
     */
    public static function anyPass(array $predicates = null)
    {
        return static::curry1(function (array $predicates) {
            return function (... $arguments) use ($predicates) {
                foreach ($predicates as $predicate) {
                    if ($predicate(...$arguments)) {
                        return true;
                    }
                }

                return false;
            };
        }, func_get_args());
    }

    /**
     * @param string       $property
     * @param mixed        $value
     * @param array|object $object
     *
     * @return callable|array|object
     */
    public static function assoc($property = null, $value = null, $object = null)
    {
        return static::curry3(function ($property, $value, $object) {
            return static::_assoc($property, $value, $object);
        }, func_get_args());
    }

    /**
     * @param array        $path
     * @param mixed        $value
     * @param array|object $object
     *
     * @return callable|array|object
     */
    public static function assocPath(array $path = null, $value = null, $object = null)
    {
        return static::curry3(function (array $path, $value, $object) {
            return static::_assocPath($path, $value, $object);
        }, func_get_args());
    }

    /**
     * @param callable $a
     * @param callable $b
     *
     * @return callable
     */
    public static function both(callable $a = null, callable $b = null)
    {
        return static::curry2(function (callable $a, callable $b) {
            return function (... $arguments) use ($a, $b) {
                return $a(...$arguments) && $b(...$arguments);
            };
        }, func_get_args());
    }

    /**
     * @param object $object
     *
     * @return callable|mixed
     */
    public static function clone_($object = null)
    {
        return static::curry1(function ($object) {
            return clone $object;
        }, func_get_args());
    }

    /**
     * @param callable $predicate
     *
     * @return callable
     */
    public static function comparator(callable $predicate = null)
    {
        return static::curry1(function (callable $predicate) {
            return function ($x, $y) use ($predicate) {
                return $predicate($x, $y) ? -1 : ($predicate($y, $x) ? 1 : 0);
            };
        }, func_get_args());
    }

    /**
     * @param callable ...$functions
     *
     * @return callable
     */
    public static function compose(... $functions)
    {
        return Phamda::pipe(...array_reverse($functions));
    }

    /**
     * @param string $class
     *
     * @return callable|object
     */
    public static function construct($class = null)
    {
        return static::curry1(function ($class) {
            return Phamda::constructN(static::getConstructorArity($class), $class);
        }, func_get_args());
    }

    /**
     * @param int    $arity
     * @param string $class
     *
     * @return callable|object
     */
    public static function constructN($arity = null, $class = null)
    {
        return static::curry2(function ($arity, $class) {
            return static::_curryN($arity, function (... $arguments) use ($class) {
                return new $class(...$arguments);
            });
        }, func_get_args());
    }

    /**
     * @param mixed              $value
     * @param array|\Traversable $collection
     *
     * @return callable|bool
     */
    public static function contains($value = null, $collection = null)
    {
        return static::curry2(function ($value, $collection) {
            foreach ($collection as $item) {
                if ($item === $value) {
                    return true;
                }
            }

            return false;
        }, func_get_args());
    }

    /**
     * @param callable $function
     * @param mixed    ...$initialArguments
     *
     * @return callable
     */
    public static function curry(callable $function = null, ... $initialArguments)
    {
        return static::curry1(function (callable $function, ... $initialArguments) {
            return static::_curryN(static::getArity($function), $function, ...$initialArguments);
        }, func_get_args());
    }

    /**
     * @param int      $length
     * @param callable $function
     * @param mixed    ...$initialArguments
     *
     * @return callable
     */
    public static function curryN($length = null, callable $function = null, ... $initialArguments)
    {
        return static::curry2(function ($length, callable $function, ... $initialArguments) {
            return static::_curryN($length, $function, ...$initialArguments);
        }, func_get_args());
    }

    /**
     * @param int|float $number
     *
     * @return callable|int|float
     */
    public static function dec($number = null)
    {
        return static::curry1(function ($number) {
            return Phamda::add(-1, $number);
        }, func_get_args());
    }

    /**
     * @param mixed $default
     * @param mixed $value
     *
     * @return callable|mixed
     */
    public static function defaultTo($default = null, $value = null)
    {
        return static::curry2(function ($default, $value) {
            return $value !== null ? $value : $default;
        }, func_get_args());
    }

    /**
     * @param int|float $x
     * @param int|float $y
     *
     * @return callable|int|float
     */
    public static function divide($x = null, $y = null)
    {
        return static::curry2(function ($x, $y) {
            return $x / $y;
        }, func_get_args());
    }

    /**
     * @param callable $a
     * @param callable $b
     *
     * @return callable
     */
    public static function either(callable $a = null, callable $b = null)
    {
        return static::curry2(function (callable $a, callable $b) {
            return function (... $arguments) use ($a, $b) {
                return $a(...$arguments) || $b(...$arguments);
            };
        }, func_get_args());
    }

    /**
     * @param mixed $x
     * @param mixed $y
     *
     * @return callable|bool
     */
    public static function eq($x = null, $y = null)
    {
        return static::curry2(function ($x, $y) {
            return $x === $y;
        }, func_get_args());
    }

    /**
     * @return callable
     */
    public static function false()
    {
        return function () {
            return false;
        };
    }

    /**
     * @param callable                      $predicate
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function filter(callable $predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            return static::_filter($predicate, $collection);
        }, func_get_args());
    }

    /**
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|mixed|null
     */
    public static function find(callable $predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            foreach ($collection as $item) {
                if ($predicate($item)) {
                    return $item;
                }
            }

            return null;
        }, func_get_args());
    }

    /**
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|int|string|null
     */
    public static function findIndex(callable $predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            foreach ($collection as $index => $item) {
                if ($predicate($item)) {
                    return $index;
                }
            }

            return null;
        }, func_get_args());
    }

    /**
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|mixed|null
     */
    public static function findLast(callable $predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            foreach (static::_reverse($collection) as $item) {
                if ($predicate($item)) {
                    return $item;
                }
            }

            return null;
        }, func_get_args());
    }

    /**
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|int|string|null
     */
    public static function findLastIndex(callable $predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            foreach (static::_reverse($collection, true) as $index => $item) {
                if ($predicate($item)) {
                    return $index;
                }
            }

            return null;
        }, func_get_args());
    }

    /**
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|mixed
     */
    public static function first($collection = null)
    {
        return static::curry1(function ($collection) {
            if (is_array($collection)) {
                return reset($collection);
            } elseif (method_exists($collection, 'first')) {
                return $collection->first();
            } else {
                foreach ($collection as $item) {
                    return $item;
                }

                return false;
            }
        }, func_get_args());
    }

    /**
     * @param callable $function
     *
     * @return callable
     */
    public static function flip(callable $function = null)
    {
        return static::curry1(function (callable $function) {
            return function ($a, $b, ... $arguments) use ($function) {
                return $function($b, $a, ...$arguments);
            };
        }, func_get_args());
    }

    /**
     * @param callable                      $function
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array[]|Collection[]
     */
    public static function groupBy(callable $function = null, $collection = null)
    {
        return static::curry2(function (callable $function, $collection) {
            if (method_exists($collection, 'groupBy')) {
                return $collection->groupBy($function);
            }

            return static::_reduce(function (array $collections, $item) use ($function) {
                $collections[$function($item)][] = $item;

                return $collections;
            }, [], $collection);
        }, func_get_args());
    }

    /**
     * @param mixed $x
     * @param mixed $y
     *
     * @return callable|bool
     */
    public static function gt($x = null, $y = null)
    {
        return static::curry2(function ($x, $y) {
            return $x > $y;
        }, func_get_args());
    }

    /**
     * @param mixed $x
     * @param mixed $y
     *
     * @return callable|bool
     */
    public static function gte($x = null, $y = null)
    {
        return static::curry2(function ($x, $y) {
            return $x >= $y;
        }, func_get_args());
    }

    /**
     * @param mixed $x
     *
     * @return callable|mixed
     */
    public static function identity($x = null)
    {
        return static::curry1(function ($x) {
            return $x;
        }, func_get_args());
    }

    /**
     * @param callable $condition
     * @param callable $onTrue
     * @param callable $onFalse
     *
     * @return callable|mixed
     */
    public static function ifElse(callable $condition = null, callable $onTrue = null, callable $onFalse = null)
    {
        return static::curry3(function (callable $condition, callable $onTrue, callable $onFalse) {
            return function (... $arguments) use ($condition, $onTrue, $onFalse) {
                return $condition(...$arguments) ? $onTrue(...$arguments) : $onFalse(...$arguments);
            };
        }, func_get_args());
    }

    /**
     * @param int|float $number
     *
     * @return callable|int|float
     */
    public static function inc($number = null)
    {
        return static::curry1(function ($number) {
            return Phamda::add(1, $number);
        }, func_get_args());
    }

    /**
     * @param mixed              $item
     * @param array|\Traversable $collection
     *
     * @return callable|int|string|false
     */
    public static function indexOf($item = null, $collection = null)
    {
        return static::curry2(function ($item, $collection) {
            foreach ($collection as $key => $current) {
                if ($item === $current) {
                    return $key;
                }
            }

            return false;
        }, func_get_args());
    }

    /**
     * @param int    $arity
     * @param string $method
     * @param mixed  ...$initialArguments
     *
     * @return callable
     */
    public static function invoker($arity, $method, ... $initialArguments)
    {
        $remainingCount = $arity - count($initialArguments) + 1;

        return static::_curryN($remainingCount, function (... $arguments) use ($method, $initialArguments) {
            $object = array_pop($arguments);

            return $object->{$method}(...array_merge($initialArguments, $arguments));
        });
    }

    /**
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|bool
     */
    public static function isEmpty($collection = null)
    {
        return static::curry1(function ($collection) {
            if (is_array($collection)) {
                return empty($collection);
            } elseif (method_exists($collection, 'isEmpty')) {
                return $collection->isEmpty();
            } else {
                foreach ($collection as $item) {
                    return false;
                }

                return true;
            }
        }, func_get_args());
    }

    /**
     * @param string $class
     * @param object $object
     *
     * @return callable|bool
     */
    public static function isInstance($class = null, $object = null)
    {
        return static::curry2(function ($class, $object) {
            return $object instanceof $class;
        }, func_get_args());
    }

    /**
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|mixed
     */
    public static function last($collection = null)
    {
        return static::curry1(function ($collection) {
            if (is_array($collection)) {
                return end($collection);
            } elseif (method_exists($collection, 'last')) {
                return $collection->last();
            } else {
                foreach (static::_reverse($collection) as $item) {
                    return $item;
                }

                return false;
            }
        }, func_get_args());
    }

    /**
     * @param mixed $x
     * @param mixed $y
     *
     * @return callable|bool
     */
    public static function lt($x = null, $y = null)
    {
        return static::curry2(function ($x, $y) {
            return $x < $y;
        }, func_get_args());
    }

    /**
     * @param mixed $x
     * @param mixed $y
     *
     * @return callable|bool
     */
    public static function lte($x = null, $y = null)
    {
        return static::curry2(function ($x, $y) {
            return $x <= $y;
        }, func_get_args());
    }

    /**
     * @param callable                      $function
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function map(callable $function = null, $collection = null)
    {
        return static::curry2(function (callable $function, $collection) {
            return static::_map($function, $collection);
        }, func_get_args());
    }

    /**
     * @param array|\Traversable $collection
     *
     * @return callable|mixed
     */
    public static function max($collection = null)
    {
        return static::curry1(function ($collection) {
            return static::getCompareResult(Phamda::gt(), $collection);
        }, func_get_args());
    }

    /**
     * @param callable           $getValue
     * @param array|\Traversable $collection
     *
     * @return callable|mixed
     */
    public static function maxBy(callable $getValue = null, $collection = null)
    {
        return static::curry2(function (callable $getValue, $collection) {
            return static::getCompareByResult(Phamda::gt(), $getValue, $collection);
        }, func_get_args());
    }

    /**
     * @param array|\Traversable $collection
     *
     * @return callable|mixed
     */
    public static function min($collection = null)
    {
        return static::curry1(function ($collection) {
            return static::getCompareResult(Phamda::lt(), $collection);
        }, func_get_args());
    }

    /**
     * @param callable           $getValue
     * @param array|\Traversable $collection
     *
     * @return callable|mixed
     */
    public static function minBy(callable $getValue = null, $collection = null)
    {
        return static::curry2(function (callable $getValue, $collection) {
            return static::getCompareByResult(Phamda::lt(), $getValue, $collection);
        }, func_get_args());
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return callable|int
     */
    public static function modulo($x = null, $y = null)
    {
        return static::curry2(function ($x, $y) {
            return $x % $y;
        }, func_get_args());
    }

    /**
     * @param int|float $x
     * @param int|float $y
     *
     * @return callable|int|float
     */
    public static function multiply($x = null, $y = null)
    {
        return static::curry2(function ($x, $y) {
            return $x * $y;
        }, func_get_args());
    }

    /**
     * @param int|float $x
     *
     * @return callable|int|float
     */
    public static function negate($x = null)
    {
        return static::curry1(function ($x) {
            return Phamda::multiply($x, -1);
        }, func_get_args());
    }

    /**
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|bool
     */
    public static function none(callable $predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            return ! Phamda::any($predicate, $collection);
        }, func_get_args());
    }

    /**
     * @param callable $predicate
     *
     * @return callable
     */
    public static function not(callable $predicate = null)
    {
        return static::curry1(function (callable $predicate) {
            return function (... $arguments) use ($predicate) {
                return ! $predicate(...$arguments);
            };
        }, func_get_args());
    }

    /**
     * @param callable $function
     * @param mixed    ...$initialArguments
     *
     * @return callable
     */
    public static function partial(callable $function, ... $initialArguments)
    {
        return Phamda::partialN(static::getArity($function), $function, ...$initialArguments);
    }

    /**
     * @param int      $arity
     * @param callable $function
     * @param mixed    ...$initialArguments
     *
     * @return callable
     */
    public static function partialN($arity, callable $function, ... $initialArguments)
    {
        $remainingCount = $arity - count($initialArguments);
        $partial        = function (... $arguments) use ($function, $initialArguments) {
            return $function(...array_merge($initialArguments, $arguments));
        };

        return $remainingCount > 0 ? static::_curryN($remainingCount, $partial) : $partial;
    }

    /**
     * @param callable                      $predicate
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array[]|Collection[]
     */
    public static function partition(callable $predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            if (method_exists($collection, 'partition')) {
                return $collection->partition($predicate);
            }

            return static::_reduce(function (array $collections, $item) use ($predicate) {
                $collections[$predicate($item) ? 0 : 1][] = $item;

                return $collections;
            }, [[], []], $collection);
        }, func_get_args());
    }

    /**
     * @param array        $path
     * @param array|object $object
     *
     * @return callable|mixed
     */
    public static function path(array $path = null, $object = null)
    {
        return static::curry2(function (array $path, $object) {
            foreach ($path as $name) {
                $object = static::_prop($name, $object);
            }

            return $object;
        }, func_get_args());
    }

    /**
     * @param array        $path
     * @param mixed        $value
     * @param array|object $object
     *
     * @return callable|boolean
     */
    public static function pathEq(array $path = null, $value = null, $object = null)
    {
        return static::curry3(function (array $path, $value, $object) {
            return Phamda::path($path, $object) === $value;
        }, func_get_args());
    }

    /**
     * @param array $names
     * @param array $item
     *
     * @return callable|array
     */
    public static function pick(array $names = null, array $item = null)
    {
        return static::curry2(function (array $names, array $item) {
            $new = [];
            foreach ($names as $name) {
                if (array_key_exists($name, $item)) {
                    $new[$name] = $item[$name];
                }
            }

            return $new;
        }, func_get_args());
    }

    /**
     * @param array $names
     * @param array $item
     *
     * @return callable|array
     */
    public static function pickAll(array $names = null, array $item = null)
    {
        return static::curry2(function (array $names, array $item) {
            $new = [];
            foreach ($names as $name) {
                $new[$name] = isset($item[$name]) ? $item[$name] : null;
            }

            return $new;
        }, func_get_args());
    }

    /**
     * @param callable ...$functions
     *
     * @return callable
     */
    public static function pipe(... $functions)
    {
        if (count($functions) < 2) {
            throw InvalidFunctionCompositionException::create();
        }

        return function (... $arguments) use ($functions) {
            $result = null;
            foreach ($functions as $function) {
                $result = $result !== null ? $function($result) : $function(...$arguments);
            }

            return $result;
        };
    }

    /**
     * @param string                        $name
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function pluck($name = null, $collection = null)
    {
        return static::curry2(function ($name, $collection) {
            return static::_map(Phamda::prop($name), $collection);
        }, func_get_args());
    }

    /**
     * @param int[]|float[] $values
     *
     * @return callable|int|float
     */
    public static function product($values = null)
    {
        return static::curry1(function ($values) {
            return static::_reduce(Phamda::multiply(), 1, $values);
        }, func_get_args());
    }

    /**
     * @param string                    $name
     * @param array|object|\ArrayAccess $object
     *
     * @return callable|mixed
     */
    public static function prop($name = null, $object = null)
    {
        return static::curry2(function ($name, $object) {
            return static::_prop($name, $object);
        }, func_get_args());
    }

    /**
     * @param string       $name
     * @param mixed        $value
     * @param array|object $object
     *
     * @return callable|bool
     */
    public static function propEq($name = null, $value = null, $object = null)
    {
        return static::curry3(function ($name, $value, $object) {
            return static::_prop($name, $object) === $value;
        }, func_get_args());
    }

    /**
     * @param callable           $function
     * @param mixed              $initial
     * @param array|\Traversable $collection
     *
     * @return callable|mixed
     */
    public static function reduce(callable $function = null, $initial = null, $collection = null)
    {
        return static::curry3(function (callable $function, $initial, $collection) {
            return static::_reduce($function, $initial, $collection);
        }, func_get_args());
    }

    /**
     * @param callable           $function
     * @param mixed              $initial
     * @param array|\Traversable $collection
     *
     * @return callable|mixed
     */
    public static function reduceRight(callable $function = null, $initial = null, $collection = null)
    {
        return static::curry3(function (callable $function, $initial, $collection) {
            return static::_reduce($function, $initial, static::_reverse($collection));
        }, func_get_args());
    }

    /**
     * @param callable                      $predicate
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function reject(callable $predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            return static::_filter(Phamda::not($predicate), $collection);
        }, func_get_args());
    }

    /**
     * @param array|\Traversable $collection
     *
     * @return callable|array
     */
    public static function reverse($collection = null)
    {
        return static::curry1(function ($collection) {
            return static::_reverse($collection);
        }, func_get_args());
    }

    /**
     * @param int                           $start
     * @param int                           $end
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function slice($start = null, $end = null, $collection = null)
    {
        return static::curry3(function ($start, $end, $collection) {
            return static::_slice($start, $end, $collection);
        }, func_get_args());
    }

    /**
     * @param callable                      $comparator
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function sort(callable $comparator = null, $collection = null)
    {
        return static::curry2(function (callable $comparator, $collection) {
            return static::_sort($comparator, $collection);
        }, func_get_args());
    }

    /**
     * @param callable                      $function
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function sortBy(callable $function = null, $collection = null)
    {
        return static::curry2(function (callable $function, $collection) {
            $comparator = function ($x, $y) use ($function) {
                $xKey = $function($x);
                $yKey = $function($y);

                return $xKey < $yKey ? -1 : ($xKey > $yKey ? 1 : 0);
            };

            return static::_sort($comparator, $collection);
        }, func_get_args());
    }

    /**
     * @param int|float $x
     * @param int|float $y
     *
     * @return callable|int|float
     */
    public static function subtract($x = null, $y = null)
    {
        return static::curry2(function ($x, $y) {
            return $x - $y;
        }, func_get_args());
    }

    /**
     * @param int[]|float[] $values
     *
     * @return callable|int|float
     */
    public static function sum($values = null)
    {
        return static::curry1(function ($values) {
            return static::_reduce(Phamda::add(), 0, $values);
        }, func_get_args());
    }

    /**
     * @param callable $function
     * @param object   $object
     *
     * @return callable|object
     */
    public static function tap(callable $function = null, $object = null)
    {
        return static::curry2(function (callable $function, $object) {
            $function($object);

            return $object;
        }, func_get_args());
    }

    /**
     * @param callable $function
     * @param int      $count
     *
     * @return callable|array
     */
    public static function times(callable $function = null, $count = null)
    {
        return static::curry2(function (callable $function, $count) {
            return static::_map($function, range(0, $count - 1));
        }, func_get_args());
    }

    /**
     * @return callable
     */
    public static function true()
    {
        return function () {
            return true;
        };
    }

    /**
     * @param array        $specification
     * @param array|object $object
     *
     * @return callable|mixed
     */
    public static function where(array $specification = null, $object = null)
    {
        return static::curry2(function (array $specification, $object) {
            foreach ($specification as $name => $part) {
                if (! static::testSpecificationPart($name, $part, $object)) {
                    return false;
                }
            }

            return true;
        }, func_get_args());
    }

    /**
     * @param array $a
     * @param array $b
     *
     * @return callable|array
     */
    public static function zip(array $a = null, array $b = null)
    {
        return static::curry2(function (array $a, array $b) {
            $zipped = [];
            foreach (array_intersect_key($a, $b) as $key => $value) {
                $zipped[$key] = [$value, $b[$key]];
            }

            return $zipped;
        }, func_get_args());
    }

    /**
     * @param callable $function
     * @param array    $a
     * @param array    $b
     *
     * @return callable|array
     */
    public static function zipWith(callable $function = null, array $a = null, array $b = null)
    {
        return static::curry3(function (callable $function, array $a, array $b) {
            $zipped = [];
            foreach (array_intersect_key($a, $b) as $key => $value) {
                $zipped[$key] = $function($value, $b[$key]);
            }

            return $zipped;
        }, func_get_args());
    }
}
