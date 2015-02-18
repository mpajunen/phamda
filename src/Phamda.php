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
    public static function all(callable $function, array $list = null)
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
     * @param callable $function
     * @param array    $list
     *
     * @return callable|bool
     */
    public static function any(callable $function, array $list = null)
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
     * @param mixed $a
     * @param mixed $b
     *
     * @return callable|bool
     */
    public static function eq($a, $b = null)
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
    public static function filter(callable $function, array $list = null)
    {
        $func = static::curry2(function (callable $function, array $list) {
            return array_filter($list, $function);
        });

        return $func(...func_get_args());
    }

    /**
     * @param callable $function
     * @param array    $list
     *
     * @return callable|array
     */
    public static function map(callable $function, array $list = null)
    {
        $func = static::curry2(function (callable $function, array $list) {
            return array_map($function, $list);
        });

        return $func(...func_get_args());
    }

    /**
     * @param string       $name
     * @param array|object $object
     *
     * @return callable|mixed
     */
    public static function prop($name, $object = null)
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
    public static function propEq($name, $value = null, $object = null)
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
    public static function reduce(callable $function, $initial = null, array $list = null)
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
    public static function sort(callable $comparator, array $list = null)
    {
        $func = static::curry2(function (callable $comparator, array $list) {
            $newList = $list;
            usort($list, $comparator);

            return $newList;
        });

        return $func(...func_get_args());
    }
}
