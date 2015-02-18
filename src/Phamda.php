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
     * @param array $names
     * @param array $item
     *
     * @return callable|array
     */
    public static function pick(array $names, array $item = null)
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
    public static function pickAll(array $names, array $item = null)
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

    /**
     * @param array $a
     * @param array $b
     *
     * @return callable|array
     */
    public static function zip(array $a, array $b = null)
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
    public static function zipWith(callable $function, array $a = null, array $b = null)
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
