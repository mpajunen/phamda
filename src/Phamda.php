<?php

namespace Phamda;

class Phamda
{
    use CoreFunctionsTrait;

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
                return call_user_func($a, ...$arguments) && call_user_func($b, ...$arguments);
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
     * @param callable ...$functions
     *
     * @return callable
     */
    public static function compose(callable ... $functions)
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
                    return call_user_func($function, ...$arguments);
                } else {
                    $existingArguments = $arguments;

                    return Phamda::curryN($remainingCount, function (... $arguments) use ($function, $existingArguments) {
                        return call_user_func($function, ...array_merge($existingArguments, $arguments));
                    });
                }
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
    public static function eq($a = null, $b = null)
    {
        $func = static::curry2(function ($a, $b) {
            return $a === $b;
        });

        return $func(...func_get_args());
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
                return call_user_func($a, ...$arguments) || call_user_func($b, ...$arguments);
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
    public static function pipe(callable ... $functions)
    {
        if (count($functions) < 2) {
            throw new \LogicException('Pipe requires at least two argument functions.');
        }

        return function (... $arguments) use ($functions) {
            $result = null;
            foreach ($functions as $function) {
                $result = call_user_func_array($function, $result ? [$result] : $arguments);
            }

            return $result;
        };
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
