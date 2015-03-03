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

trait CoreFunctionsTrait
{
    protected static function getArity(callable $a)
    {
        if (is_string($a) || $a instanceof \Closure) {
            $function = new \ReflectionFunction($a);
        } elseif (is_array($a)) {
            list($class, $name) = $a;

            $function = new \ReflectionMethod($class, $name);
        } else {
            throw new \LogicException('Invalid callable.');
        }

        return $function->getNumberOfRequiredParameters();
    }

    protected static function getConstructorArity($class)
    {
        return (new \ReflectionClass($class))
            ->getConstructor()
            ->getNumberOfRequiredParameters();
    }

    protected static function getCompareByResult(callable $comparator, callable $getValue, array $list)
    {
        $comparison = null;
        $result     = null;

        foreach ($list as $item) {
            $value = $getValue($item);
            if ($comparison === null || $comparator($value, $comparison)) {
                $comparison = $value;
                $result     = $item;
            }
        }

        return $result;
    }

    protected static function getCompareResult(callable $comparator, array $list)
    {
        $result = null;
        foreach ($list as $value) {
            if ($result === null || $comparator($value, $result)) {
                $result = $value;
            }
        }

        return $result;
    }

    protected static function _curryN($length, callable $function, ...$initialArguments)
    {
        return $length - count($initialArguments) <= 0
            ? $function(...$initialArguments)
            : function (... $arguments) use ($length, $function, $initialArguments) {
                return static::_curryN($length, function (... $arguments) use ($function) {
                    return $function(...$arguments);
                }, ...array_merge($initialArguments, $arguments));
            };
    }

    protected static function curry1(callable $original)
    {
        return function ($a = null, ...$initialArguments) use ($original) {
            switch (func_num_args()) {
                case 0:
                    return $original;
                default:
                    return $original($a, ...$initialArguments);
            }
        };
    }

    protected static function curry2(callable $original)
    {
        return function ($a = null, $b = null, ...$initialArguments) use ($original) {
            switch (func_num_args()) {
                case 0:
                    return function ($a, $b = null, ...$arguments) use ($original) {
                        $curried = self::curry2($original);

                        return $curried(...func_get_args());
                    };
                case 1:
                    return function ($b, ...$arguments) use ($original, $a) {
                        return $original($a, ...func_get_args());
                    };
                    break;
                default:
                    return $original($a, $b, ...$initialArguments);
            }
        };
    }

    protected static function curry3(callable $original)
    {
        return function ($a = null, $b = null, $c = null, ...$initialArguments) use ($original) {
            switch (func_num_args()) {
                case 0:
                    return function ($a, $b = null, $c = null, ...$arguments) use ($original) {
                        $curried = self::curry3($original);

                        return $curried(...func_get_args());
                    };
                case 1:
                    return self::curry2(function ($b, $c = null, ...$arguments) use ($original, $a) {
                        $curried = self::curry2($original);

                        return $curried($a, ...func_get_args());
                    });
                case 2:
                    return function ($c, ...$arguments) use ($original, $a, $b) {
                        return $original($a, $b, ...func_get_args());
                    };
                    break;
                default:
                    return $original($a, $b, $c, ...$initialArguments);
            }
        };
    }

    protected static function testSpecificationPart($name, $part, $object)
    {
        $value = Phamda::prop($name, $object);

        return is_callable($part)
            ? $part($value, $object)
            : $value === $part;
    }
}
