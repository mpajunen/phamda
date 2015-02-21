<?php

namespace Phamda;

trait CoreFunctionsTrait
{
    /**
     * @param callable $a
     * @param callable $b
     *
     * @return callable
     */
    public static function compose(callable $a, callable $b)
    {
        return function (... $arguments) use ($a, $b) {
            return call_user_func($a, call_user_func($b, ...$arguments));
        };
    }

    /**
     * @param callable $function
     *
     * @return callable
     */
    public static function not(callable $function)
    {
        return function (... $arguments) use ($function) {
            return ! $function(...$arguments);
        };
    }

    protected static function curry2(callable $original)
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

    protected static function curry3(callable $original)
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
}
