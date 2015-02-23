<?php

namespace Phamda;

class Phamda
{
    use CoreFunctionsTrait;

    /**
     * @param int|float $a
     * @param int|float $b
     *
     * @return callable|int|float
     */
    public static function add($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a + $b;
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $function
     * @param array    $list
     *
     * @return callable|bool
     */
    public static function all(callable $function = null, array $list = null)
    {
        $func = static::curry2(function (callable $function, array $list) {
            foreach ($list as $value) {
                if (! $function($value)) {
                    return false;
                }
            }

            return true;
        });

        return $func(...func_get_args());
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
     * @param callable $a
     * @param callable $b
     *
     * @return callable
     */
    public static function and_(callable $a = null, callable $b = null)
    {
        $func = static::curry2(function (callable $a, callable $b) {
            return function (... $arguments) use ($a, $b) {
                return $a(...$arguments) && $b(...$arguments);
            };
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $function
     * @param array    $list
     *
     * @return callable|bool
     */
    public static function any(callable $function = null, array $list = null)
    {
        $func = static::curry2(function (callable $function, array $list) {
            foreach ($list as $value) {
                if ($function($value)) {
                    return true;
                }
            }

            return false;
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $predicate
     *
     * @return callable
     */
    public static function comparator(callable $predicate = null)
    {
        $func = static::curry1(function (callable $predicate) {
            return function ($a, $b) use ($predicate) {
                return $predicate($a, $b) ? -1 : ($predicate($b, $a) ? 1 : 0);
            };
        });

        return $func(...func_get_args());
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
     * @param callable $function
     *
     * @return callable
     */
    public static function curry(callable $function = null)
    {
        $func = static::curry1(function (callable $function) {
            $reflection = static::createReflection($function);

            return Phamda::curryN($reflection->getNumberOfParameters(), $function);
        });

        return $func(...func_get_args());
    }

    /**
     * @param int      $count
     * @param callable $function
     *
     * @return callable
     */
    public static function curryN($count = null, callable $function = null)
    {
        $func = static::curry2(function ($count, callable $function) {
            return function (... $arguments) use ($function, $count) {
                $remainingCount = $count - count($arguments);
                if ($remainingCount <= 0) {
                    return $function(...$arguments);
                } else {
                    $existingArguments = $arguments;

                    return Phamda::curryN($remainingCount, function (... $arguments) use ($function, $existingArguments) {
                        return $function(...array_merge($existingArguments, $arguments));
                    });
                }
            };
        });

        return $func(...func_get_args());
    }

    /**
     * @param int|float $a
     * @param int|float $b
     *
     * @return callable|int|float
     */
    public static function divide($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a / $b;
        });

        return $func(...func_get_args());
    }

    /**
     * @param mixed $a
     * @param mixed $b
     *
     * @return callable|bool
     */
    public static function eq($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a === $b;
        });

        return $func(...func_get_args());
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
     * @param callable $function
     * @param array    $list
     *
     * @return callable|array
     */
    public static function filter(callable $function = null, array $list = null)
    {
        $func = static::curry2(function (callable $function, array $list) {
            return array_filter($list, $function);
        });

        return $func(...func_get_args());
    }

    /**
     * @param array $list
     *
     * @return callable|mixed
     */
    public static function first(array $list = null)
    {
        $func = static::curry1(function (array $list) {
            return reset($list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $function
     *
     * @return callable
     */
    public static function flip(callable $function = null)
    {
        $func = static::curry1(function (callable $function) {
            return function ($a, $b, ... $arguments) use ($function) {
                return $function($b, $a, ...$arguments);
            };
        });

        return $func(...func_get_args());
    }

    /**
     * @param mixed $a
     * @param mixed $b
     *
     * @return callable|bool
     */
    public static function gt($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a > $b;
        });

        return $func(...func_get_args());
    }

    /**
     * @param mixed $a
     * @param mixed $b
     *
     * @return callable|bool
     */
    public static function gte($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a >= $b;
        });

        return $func(...func_get_args());
    }

    /**
     * @param mixed $a
     *
     * @return callable|mixed
     */
    public static function identity($a = null)
    {
        $func = static::curry1(function ($a) {
            return $a;
        });

        return $func(...func_get_args());
    }

    /**
     * @param array $list
     *
     * @return callable|mixed
     */
    public static function last(array $list = null)
    {
        $func = static::curry1(function (array $list) {
            return end($list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param mixed $a
     * @param mixed $b
     *
     * @return callable|bool
     */
    public static function lt($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a < $b;
        });

        return $func(...func_get_args());
    }

    /**
     * @param mixed $a
     * @param mixed $b
     *
     * @return callable|bool
     */
    public static function lte($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a <= $b;
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $function
     * @param array    $list
     *
     * @return callable|array
     */
    public static function map(callable $function = null, array $list = null)
    {
        $func = static::curry2(function (callable $function, array $list) {
            return array_map($function, $list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param array $list
     *
     * @return callable|mixed
     */
    public static function max(array $list = null)
    {
        $func = static::curry1(function (array $list) {
            return static::getCompareResult(Phamda::gt(), $list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $getValue
     * @param array    $list
     *
     * @return callable|mixed
     */
    public static function maxBy(callable $getValue = null, array $list = null)
    {
        $func = static::curry2(function (callable $getValue, array $list) {
            return static::getCompareByResult(Phamda::gt(), $getValue, $list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param array $list
     *
     * @return callable|mixed
     */
    public static function min(array $list = null)
    {
        $func = static::curry1(function (array $list) {
            return static::getCompareResult(Phamda::lt(), $list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $getValue
     * @param array    $list
     *
     * @return callable|mixed
     */
    public static function minBy(callable $getValue = null, array $list = null)
    {
        $func = static::curry2(function (callable $getValue, array $list) {
            return static::getCompareByResult(Phamda::lt(), $getValue, $list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param int $a
     * @param int $b
     *
     * @return callable|int
     */
    public static function modulo($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a % $b;
        });

        return $func(...func_get_args());
    }

    /**
     * @param int|float $a
     * @param int|float $b
     *
     * @return callable|int|float
     */
    public static function multiply($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a * $b;
        });

        return $func(...func_get_args());
    }

    /**
     * @param int|float $a
     *
     * @return callable|int|float
     */
    public static function negate($a = null)
    {
        $func = static::curry1(function ($a) {
            return Phamda::multiply($a, -1);
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $function
     * @param array    $list
     *
     * @return callable|bool
     */
    public static function none(callable $function = null, array $list = null)
    {
        $func = static::curry2(function (callable $function, array $list) {
            return ! Phamda::any($function, $list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $function
     *
     * @return callable
     */
    public static function not(callable $function = null)
    {
        $func = static::curry1(function (callable $function) {
            return function (... $arguments) use ($function) {
                return ! $function(...$arguments);
            };
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $a
     * @param callable $b
     *
     * @return callable
     */
    public static function or_(callable $a = null, callable $b = null)
    {
        $func = static::curry2(function (callable $a, callable $b) {
            return function (... $arguments) use ($a, $b) {
                return $a(...$arguments) || $b(...$arguments);
            };
        });

        return $func(...func_get_args());
    }

    /**
     * @param array $names
     * @param array $item
     *
     * @return callable|array
     */
    public static function pick(array $names = null, array $item = null)
    {
        $func = static::curry2(function (array $names, array $item) {
            $new = [];
            foreach ($names as $name) {
                if (array_key_exists($name, $item)) {
                    $new[$name] = $item[$name];
                }
            }

            return $new;
        });

        return $func(...func_get_args());
    }

    /**
     * @param array $names
     * @param array $item
     *
     * @return callable|array
     */
    public static function pickAll(array $names = null, array $item = null)
    {
        $func = static::curry2(function (array $names, array $item) {
            $new = [];
            foreach ($names as $name) {
                $new[$name] = isset($item[$name]) ? $item[$name] : null;
            }

            return $new;
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable ...$functions
     *
     * @return callable
     */
    public static function pipe(... $functions)
    {
        if (count($functions) < 2) {
            throw new \LogicException('Pipe requires at least two argument functions.');
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
     * @param string $name
     * @param array  $list
     *
     * @return callable|mixed
     */
    public static function pluck($name = null, array $list = null)
    {
        $func = static::curry2(function ($name, array $list) {
            return Phamda::map(Phamda::prop($name), $list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param int[]|float[] $values
     *
     * @return callable|int|float
     */
    public static function product(array $values = null)
    {
        $func = static::curry1(function (array $values) {
            return Phamda::reduce(Phamda::multiply(), 1, $values);
        });

        return $func(...func_get_args());
    }

    /**
     * @param string       $name
     * @param array|object $object
     *
     * @return callable|mixed
     */
    public static function prop($name = null, $object = null)
    {
        $func = static::curry2(function ($name, $object) {
            return is_object($object) ? $object->{$name} : $object[$name];
        });

        return $func(...func_get_args());
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
        $func = static::curry3(function ($name, $value, $object) {
            return is_object($object) ? $object->{$name} === $value : $object[$name] === $value;
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $function
     * @param mixed    $initial
     * @param array    $list
     *
     * @return callable|mixed
     */
    public static function reduce(callable $function = null, $initial = null, array $list = null)
    {
        $func = static::curry3(function (callable $function, $initial, array $list) {
            return array_reduce($list, $function, $initial);
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $function
     * @param array    $list
     *
     * @return callable|array
     */
    public static function reject(callable $function = null, array $list = null)
    {
        $func = static::curry2(function (callable $function, array $list) {
            return Phamda::filter(Phamda::not($function), $list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param array $list
     *
     * @return callable|array
     */
    public static function reverse(array $list = null)
    {
        $func = static::curry1(function (array $list) {
            return array_reverse($list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param int   $start
     * @param int   $end
     * @param array $list
     *
     * @return callable|array
     */
    public static function slice($start = null, $end = null, array $list = null)
    {
        $func = static::curry3(function ($start, $end, array $list) {
            return array_slice($list, $start, $end - $start);
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $comparator
     * @param array    $list
     *
     * @return callable|array
     */
    public static function sort(callable $comparator = null, array $list = null)
    {
        $func = static::curry2(function (callable $comparator, array $list) {
            usort($list, $comparator);

            return $list;
        });

        return $func(...func_get_args());
    }

    /**
     * @param int|float $a
     * @param int|float $b
     *
     * @return callable|int|float
     */
    public static function subtract($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a - $b;
        });

        return $func(...func_get_args());
    }

    /**
     * @param int[]|float[] $values
     *
     * @return callable|int|float
     */
    public static function sum(array $values = null)
    {
        $func = static::curry1(function (array $values) {
            return Phamda::reduce(Phamda::add(), 0, $values);
        });

        return $func(...func_get_args());
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
     * @param array $a
     * @param array $b
     *
     * @return callable|array
     */
    public static function zip(array $a = null, array $b = null)
    {
        $func = static::curry2(function (array $a, array $b) {
            $zipped = [];
            foreach (array_intersect_key($a, $b) as $key => $value) {
                $zipped[$key] = [$value, $b[$key]];
            }

            return $zipped;
        });

        return $func(...func_get_args());
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
        $func = static::curry3(function (callable $function, array $a, array $b) {
            $zipped = [];
            foreach (array_intersect_key($a, $b) as $key => $value) {
                $zipped[$key] = $function($value, $b[$key]);
            }

            return $zipped;
        });

        return $func(...func_get_args());
    }
}
