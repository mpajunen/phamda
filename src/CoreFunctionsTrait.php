<?php

namespace Phamda;

trait CoreFunctionsTrait
{
    protected static function createReflection(callable $a)
    {
        if (is_string($a) || $a instanceof \Closure) {
            return new \ReflectionFunction($a);
        } elseif (is_array($a)) {
            list($class, $name) = $a;
            return new \ReflectionMethod($class, $name);
        } else {
            throw new \LogicException('Invalid callable.');
        }
    }

    protected static function curry1(callable $original)
    {
        return function ($a = null) use ($original) {
            switch (func_num_args()) {
                case 0:
                    return $original;
                default:
                    return $original($a);
            }
        };
    }

    protected static function curry2(callable $original)
    {
        return function ($a = null, $b = null) use ($original) {
            switch (func_num_args()) {
                case 0:
                    return $original;
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

    protected static function curry3(callable $original)
    {
        return function ($a = null, $b = null, $c = null) use ($original) {
            switch (func_num_args()) {
                case 0:
                    return $original;
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
}
