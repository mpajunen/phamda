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
    protected static function getArity(callable $function)
    {
        if (is_string($function) || $function instanceof \Closure) {
            $function = new \ReflectionFunction($function);
        } elseif (is_array($function)) {
            list($class, $name) = $function;

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

    protected static function getCompareByResult(callable $comparator, callable $getValue, array $collection)
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

    protected static function getCompareResult(callable $comparator, array $collection)
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
        return $length - count($initialArguments) <= 0
            ? $function(...$initialArguments)
            : function (... $arguments) use ($length, $function, $initialArguments) {
                return static::_curryN($length, function (... $arguments) use ($function) {
                    return $function(...$arguments);
                }, ...array_merge($initialArguments, $arguments));
            };
    }

    protected static function curry1(callable $original, array $initialArguments)
    {
        return count($initialArguments) === 0 ? $original : $original(...$initialArguments);
    }

    protected static function curry2(callable $original, array $initialArguments)
    {
        switch (count($initialArguments)) {
            case 0:
                return function (...$arguments) use ($original) {
                    return self::curry2($original, $arguments);
                };
            case 1:
                return function (...$arguments) use ($original, $initialArguments) {
                    return $original(...array_merge($initialArguments, $arguments));
                };
            default:
                return $original(...$initialArguments);
        }
    }

    protected static function curry3(callable $original, array $initialArguments)
    {
        switch (count($initialArguments)) {
            case 0:
                return function (...$arguments) use ($original) {
                    return self::curry3($original, $arguments);
                };
            case 1:
                return function (...$arguments) use ($original, $initialArguments) {
                    return self::curry3($original, array_merge($initialArguments, $arguments));
                };
            case 2:
                return function (...$arguments) use ($original, $initialArguments) {
                    return $original(...array_merge($initialArguments, $arguments));
                };
            default:
                return $original(...$initialArguments);
        }
    }

    protected static function testSpecificationPart($name, $part, $object)
    {
        $value = Phamda::prop($name, $object);

        return is_callable($part)
            ? $part($value, $object)
            : $value === $part;
    }
}
