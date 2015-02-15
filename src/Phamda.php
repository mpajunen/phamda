<?php

namespace Phamda;

class Phamda
{
    public static function compose(callable $a, callable $b)
    {
        return function () use ($a, $b) {
            return call_user_func($a, call_user_func($b, ...func_get_args()));
        };
    }

    public static function filter(callable $function, array $list = null)
    {
        $func = self::curry2([__CLASS__, '_filter']);

        return $func(...func_get_args());
    }

    public static function map(callable $function, array $list = null)
    {
        $func = self::curry2([__CLASS__, '_map']);

        return $func(...func_get_args());
    }

    public static function propEq($name, $value = null, $object = null)
    {
        $func = self::curry3([__CLASS__, '_propEq']);

        return $func(...func_get_args());
    }

    public static function reduce(callable $function, $initial = null, array $list = null)
    {
        $func = self::curry3([__CLASS__, '_reduce']);

        return $func(...func_get_args());
    }

    public static function sort(callable $comparator, array $list = null)
    {
        $func = self::curry2([__CLASS__, '_sort']);

        return $func(...func_get_args());
    }

    private static function curry2(callable $original)
    {
        return function ($a = null, $b = null) use ($original) {
            switch (func_num_args()) {
                case 0:
                    throw new \LogicException('Function called with 0 arguments.');
                case 1:
                    return function ($b) use ($original, $a) {
                        return $original($a, $b);
                    };
                    break;
                default:
                    return $original($a, $b);
            }
        };
    }

    private static function curry3(callable $original)
    {
        return function ($a = null, $b = null, $c = null) use ($original) {
            switch (func_num_args()) {
                case 0:
                    throw new \LogicException('Function called with 0 arguments.');
                case 1:
                    return self::curry2(function ($b, $c) use ($original, $a) {
                        return $original($a, $b, $c);
                    });
                case 2:
                    return function ($c) use ($original, $a, $b) {
                        return $original($a, $b, $c);
                    };
                    break;
                default:
                    return $original($a, $b, $c);
            }
        };
    }

    protected static function _filter(callable $function, array $list)
    {
        return array_filter($list, $function);
    }

    protected static function _map(callable $function, array $list)
    {
        return array_map($function, $list);
    }

    protected static function _propEq($name, $value, $object)
    {
        return is_object($object)
            ? $object->$name === $value
            : $object[$name] === $value;
    }

    protected static function _reduce(callable $function, $initial, array $list)
    {
        return array_reduce($list, $function, $initial);
    }

    protected static function _sort(callable $comparator, array $list)
    {
        $newList = $list;

        usort($list, $comparator);

        return $newList;
    }
}
