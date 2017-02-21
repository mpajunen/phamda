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

/**
 * The main API class of Phamda.
 *
 * This class is automatically generated using the `\Phamda\CodeGen\Builder\InnerFunctions` class.
 *
 * For details about the code generation, please see the build directory.
 */
class Phamda
{
    use CoreFunctionsTrait;

    /**
     * Returns a placeholder to be used with curried functions.
     *
     * ```php
     * $sub10 = P::subtract(P::_(), 10);
     * $sub10(52); // => 42
     * ```
     *
     * @return Placeholder
     */
    public static function _()
    {
        return static::$placeholder ?: (static::$placeholder = new Placeholder());
    }

    /**
     * Adds two numbers.
     *
     * ```php
     * P::add(15, 27); // => 42
     * P::add(36, -8); // => 28
     * ```
     *
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
     * Returns `true` if all elements of the collection match the predicate, `false` otherwise.
     *
     * ```php
     * $isPositive = function ($x) { return $x > 0; };
     * P::all($isPositive, [1, 2, 0, -5]); // => false
     * P::all($isPositive, [1, 2, 1, 11]); // => true
     * ```
     *
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|bool
     */
    public static function all($predicate = null, $collection = null)
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
     * Creates a single predicate from a list of predicates that returns `true` when all the predicates match, `false` otherwise.
     *
     * ```php
     * $isEven = function ($x) { return $x % 2 === 0; };
     * $isPositive = function ($x) { return $x > 0; };
     * $isEvenAndPositive = P::allPass([$isEven, $isPositive]);
     * $isEvenAndPositive(5); // => false
     * $isEvenAndPositive(-4); // => false
     * $isEvenAndPositive(6); // => true
     * ```
     *
     * @param callable[] $predicates
     *
     * @return callable
     */
    public static function allPass($predicates = null)
    {
        return static::curry1(function (array $predicates) {
            return function (...$arguments) use ($predicates) {
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
     * Returns a function that always returns the passed value.
     *
     * ```php
     * $alwaysFoo = P::always('foo');
     * $alwaysFoo(); // => 'foo'
     * ```
     *
     * @param mixed $value
     *
     * @return callable
     */
    public static function always($value = null)
    {
        return static::curry1(function ($value) {
            return function () use ($value) {
                return $value;
            };
        }, func_get_args());
    }

    /**
     * Returns `true` if any element of the collection matches the predicate, `false` otherwise.
     *
     * ```php
     * $isPositive = function ($x) { return $x > 0; };
     * P::any($isPositive, [1, 2, 0, -5]); // => true
     * P::any($isPositive, [-3, -7, -1, -5]); // => false
     * ```
     *
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|bool
     */
    public static function any($predicate = null, $collection = null)
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
     * Creates a single predicate from a list of predicates that returns `true` when any of the predicates matches, `false` otherwise.
     *
     * ```php
     * $isEven = function ($x) { return $x % 2 === 0; };
     * $isPositive = function ($x) { return $x > 0; };
     * $isEvenOrPositive = P::anyPass([$isEven, $isPositive]);
     * $isEvenOrPositive(5); // => true
     * $isEvenOrPositive(-4); // => true
     * $isEvenOrPositive(-3); // => false
     * ```
     *
     * @param callable[] $predicates
     *
     * @return callable
     */
    public static function anyPass($predicates = null)
    {
        return static::curry1(function (array $predicates) {
            return function (...$arguments) use ($predicates) {
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
     * Return a new collection that contains all the items in the given collection and the given item last.
     *
     * ```php
     * P::append('c', ['a', 'b']); // => ['a', 'b', 'c']
     * P::append('c', []); // => ['c']
     * P::append(['d', 'e'], ['a', 'b']); // => ['a', 'b', ['d', 'e']]
     * ```
     *
     * @param mixed            $item
     * @param array|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function append($item = null, $collection = null)
    {
        return static::curry2(function ($item, $collection) {
            if (is_array($collection)) {
                $collection[] = $item;

                return $collection;
            } elseif (method_exists($collection, 'append')) {
                return $collection->append($item);
            } else {
                foreach ($collection as $collectionItem) {
                    $items[] = $collectionItem;
                }
                $items[] = $item;

                return $items;
            }
        }, func_get_args());
    }

    /**
     * Calls the `function` using the values of the given `arguments` list as positional arguments.
     *
     * Effectively creates an unary function from a variadic function.
     *
     * ```php
     * $concat3 = function ($a, $b, $c) { return $a . $b . $c; };
     * P::apply($concat3, ['foo', 'ba', 'rba']); // => 'foobarba'
     * ```
     *
     * @param callable $function
     * @param array    $arguments
     *
     * @return callable|mixed
     */
    public static function apply($function = null, $arguments = null)
    {
        return static::curry2(function (callable $function, array $arguments) {
            return $function(...$arguments);
        }, func_get_args());
    }

    /**
     * Returns a new array or object, setting the given value to the specified property.
     *
     * ```php
     * P::assoc('bar', 3, ['foo' => 1]); // => ['foo' => 1, 'bar' => 3]
     * P::assoc('bar', 3, ['foo' => 1, 'bar' => 2]); // => ['foo' => 1, 'bar' => 3]
     * P::assoc('foo', null, ['foo' => 15, 'bar' => 7]); // => ['foo' => null, 'bar' => 7]
     * ```
     *
     * @param string       $property
     * @param mixed        $value
     * @param array|object $object
     *
     * @return callable|array|object
     */
    public static function assoc($property = null, $value = null, $object = null)
    {
        return static::curry3(function (string $property, $value, $object) {
            return static::_assoc($property, $value, $object);
        }, func_get_args());
    }

    /**
     * Returns a new array or object, setting the given value to the property specified by the path.
     *
     * ```php
     * P::assocPath(['bar'], 3, ['foo' => 1, 'bar' => 2]); // => ['foo' => 1, 'bar' => 3]
     * P::assocPath(['bar', 'baz'], 4, ['foo' => 1, 'bar' => []]); // => ['foo' => 1, 'bar' => ['baz' => 4]]
     * ```
     *
     * @param array        $path
     * @param mixed        $value
     * @param array|object $object
     *
     * @return callable|array|object
     */
    public static function assocPath($path = null, $value = null, $object = null)
    {
        return static::curry3(function (array $path, $value, $object) {
            return static::_assocPath($path, $value, $object);
        }, func_get_args());
    }

    /**
     * Wraps the given function in a function that accepts exactly two parameters.
     *
     * ```php
     * $add3 = function ($a = 0, $b = 0, $c = 0) { return $a + $b + $c; };
     * $add2 = P::binary($add3);
     * $add2(27, 15, 33); // => 42
     * ```
     *
     * @param callable $function
     *
     * @return callable
     */
    public static function binary($function = null)
    {
        return static::curry1(function (callable $function) {
            return function ($a, $b) use ($function) {
                return $function($a, $b);
            };
        }, func_get_args());
    }

    /**
     * Returns a function that returns `true` when both of the predicates match, `false` otherwise.
     *
     * ```php
     * $lt = function ($x, $y) { return $x < $y; };
     * $arePositive = function ($x, $y) { return $x > 0 && $y > 0; };
     * $test = P::both($lt, $arePositive);
     * $test(9, 4); // => false
     * $test(-3, 11); // => false
     * $test(5, 17); // => true
     * ```
     *
     * @param callable $a
     * @param callable $b
     *
     * @return callable
     */
    public static function both($a = null, $b = null)
    {
        return static::curry2(function (callable $a, callable $b) {
            return function (...$arguments) use ($a, $b) {
                return $a(...$arguments) && $b(...$arguments);
            };
        }, func_get_args());
    }

    /**
     * Return the given `value` cast to the given `type`.
     *
     * ```php
     * P::cast('string', 3); // => '3'
     * P::cast('int', 4.55); // => 4
     * ```
     *
     * @param string $type
     * @param mixed  $value
     *
     * @return callable|mixed
     */
    public static function cast($type = null, $value = null)
    {
        return static::curry2(function (string $type, $value) {
            settype($value, $type);

            return $value;
        }, func_get_args());
    }

    /**
     * Clones an object.
     *
     *
     * @param object $object
     *
     * @return callable|object
     */
    public static function clone_($object = null)
    {
        return static::curry1(function ($object) {
            return clone $object;
        }, func_get_args());
    }

    /**
     * Creates a comparator function from a function that returns whether the first argument is less than the second.
     *
     * ```php
     * $lt = function ($x, $y) { return $x < $y; };
     * $compare = P::comparator($lt);
     * $compare(5, 6); // => -1
     * $compare(6, 5); // => 1
     * $compare(5, 5); // => 0
     * ```
     *
     * @param callable $predicate
     *
     * @return callable
     */
    public static function comparator($predicate = null)
    {
        return static::curry1(function (callable $predicate) {
            return function ($x, $y) use ($predicate) {
                return $predicate($x, $y) ? -1 : ($predicate($y, $x) ? 1 : 0);
            };
        }, func_get_args());
    }

    /**
     * Returns a new function that calls each supplied function in turn in reverse order and passes the result as a parameter to the next function.
     *
     * ```php
     * $add5 = function ($x) { return $x + 5; };
     * $square = function ($x) { return $x ** 2; };
     * $addToSquared = P::compose($add5, $square);
     * $addToSquared(4); // => 21
     * $hello = function ($target) { return 'Hello ' . $target; };
     * $helloUpper = P::compose($hello, 'strtoupper');
     * $upperHello = P::compose('strtoupper', $hello);
     * $helloUpper('world'); // => 'Hello WORLD'
     * $upperHello('world'); // => 'HELLO WORLD'
     * ```
     *
     * @param callable ...$functions
     *
     * @return callable
     */
    public static function compose(...$functions)
    {
        return self::pipe(...array_reverse($functions));
    }

    /**
     * Returns a string concatenated of `a` and `b`.
     *
     * ```php
     * P::concat('ab', 'cd'); // => 'abcd'
     * P::concat('abc', ''); // => 'abc'
     * ```
     *
     * @param string $a
     * @param string $b
     *
     * @return callable|string
     */
    public static function concat($a = null, $b = null)
    {
        return static::curry2(function (string $a, string $b) {
            return $a . $b;
        }, func_get_args());
    }

    /**
     * Wraps the constructor of the given class to a function.
     *
     * ```php
     * $date = P::construct(\DateTime::class, '2015-03-15');
     * $date->format('Y-m-d'); // => '2015-03-15'
     * ```
     *
     * @param string $class
     * @param mixed  ...$initialArguments
     *
     * @return callable|object
     */
    public static function construct($class = null, ...$initialArguments)
    {
        return static::curry1(function (string $class, ...$initialArguments) {
            return Phamda::constructN(static::getConstructorArity($class), $class, ...$initialArguments);
        }, func_get_args());
    }

    /**
     * Wraps the constructor of the given class to a function of specified arity.
     *
     * ```php
     * $construct = P::constructN(1, \DateTime::class);
     * $construct('2015-03-15')->format('Y-m-d'); // => '2015-03-15'
     * ```
     *
     * @param int    $arity
     * @param string $class
     * @param mixed  ...$initialArguments
     *
     * @return callable|object
     */
    public static function constructN($arity = null, $class = null, ...$initialArguments)
    {
        return static::curry2(function (int $arity, string $class, ...$initialArguments) {
            return static::_curryN($arity, function (...$arguments) use ($class) {
                return new $class(...array_merge($arguments));
            }, ...$initialArguments);
        }, func_get_args());
    }

    /**
     * Returns `true` if the specified item is found in the collection, `false` otherwise.
     *
     * ```php
     * P::contains('a', ['a', 'b', 'c', 'e']); // => true
     * P::contains('d', ['a', 'b', 'c', 'e']); // => false
     * ```
     *
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
     * Wraps the given function to a function that returns a new function until all required parameters are given.
     *
     * ```php
     * $add = function ($x, $y, $z) { return $x + $y + $z; };
     * $addHundred = P::curry($add, 100);
     * $addHundred(20, 3); // => 123
     * ```
     *
     * @param callable $function
     * @param mixed    ...$initialArguments
     *
     * @return callable|mixed
     */
    public static function curry($function = null, ...$initialArguments)
    {
        return static::curry1(function (callable $function, ...$initialArguments) {
            return static::_curryN(static::getArity($function), $function, ...$initialArguments);
        }, func_get_args());
    }

    /**
     * Wraps the given function to a function of specified arity that returns a new function until all required parameters are given.
     *
     * ```php
     * $add = function ($x, $y, $z = 0) { return $x + $y + $z; };
     * $addTen = P::curryN(3, $add, 10);
     * $addTen(10, 3); // => 23
     * $addTwenty = $addTen(10);
     * $addTwenty(5); // => 25
     * ```
     *
     * @param int      $length
     * @param callable $function
     * @param mixed    ...$initialArguments
     *
     * @return callable|mixed
     */
    public static function curryN($length = null, $function = null, ...$initialArguments)
    {
        return static::curry2(function (int $length, callable $function, ...$initialArguments) {
            return static::_curryN($length, $function, ...$initialArguments);
        }, func_get_args());
    }

    /**
     * Decrements the given number.
     *
     * ```php
     * P::dec(43); // => 42
     * P::dec(-14); // => -15
     * ```
     *
     * @param int|float $number
     *
     * @return callable|int|float
     *
     * @deprecated Since version 0.7, to be removed in 0.8. Use `add(-1)` instead.
     */
    public static function dec($number = null)
    {
        return static::curry1(function ($number) {
            return Phamda::add(-1, $number);
        }, func_get_args());
    }

    /**
     * Returns the default argument if the value argument is `null`.
     *
     * ```php
     * P::defaultTo(22, 15); // => 15
     * P::defaultTo(42, null); // => 42
     * P::defaultTo(15, false); // => false
     * ```
     *
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
     * Divides two numbers.
     *
     * ```php
     * P::divide(55, 11); // => 5
     * P::divide(48, -8); // => -6
     * ```
     *
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
     * Calls the given function for each element in the collection and returns the original collection.
     *
     * The supplied `function` receives three arguments: `item`, `index`, `collection`.
     *
     * ```php
     * $date = new \DateTime('2015-02-02');
     * $addCalendar = function ($number, $type) use ($date) { $date->modify("+{$number} {$type}"); };
     * P::each($addCalendar, ['months' => 3, 'weeks' => 6, 'days' => 2]);
     * $date->format('Y-m-d'); // => '2015-06-15'
     * ```
     *
     * @param callable                      $function
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|\Traversable|Collection
     */
    public static function each($function = null, $collection = null)
    {
        return static::curry2(function (callable $function, $collection) {
            foreach ($collection as $key => $item) {
                $function($item, $key, $collection);
            }

            return $collection;
        }, func_get_args());
    }

    /**
     * Returns a function that returns `true` when either of the predicates matches, `false` otherwise.
     *
     * ```php
     * $lt = function ($x, $y) { return $x < $y; };
     * $arePositive = function ($x, $y) { return $x > 0 && $y > 0; };
     * $test = P::either($lt, $arePositive);
     * $test(-5, -16); // => false
     * $test(-3, 11); // => true
     * $test(17, 3); // => true
     * ```
     *
     * @param callable $a
     * @param callable $b
     *
     * @return callable
     */
    public static function either($a = null, $b = null)
    {
        return static::curry2(function (callable $a, callable $b) {
            return function (...$arguments) use ($a, $b) {
                return $a(...$arguments) || $b(...$arguments);
            };
        }, func_get_args());
    }

    /**
     * Return true when the arguments are strictly equal.
     *
     * ```php
     * P::eq('a', 'a'); // => true
     * P::eq('a', 'b'); // => false
     * P::eq(null, null); // => true
     * ```
     *
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
     * Returns a new object or array containing all the fields of the original `object`, using given `transformations`.
     *
     * ```php
     * $object = ['foo' => 'bar', 'fiz' => 'buz'];
     * P::evolve(['foo' => 'strtoupper'], $object); // => ['foo' => 'BAR', 'fiz' => 'buz']
     * ```
     *
     * @param callable[]                $transformations
     * @param array|object|\ArrayAccess $object
     *
     * @return callable|array|object
     */
    public static function evolve($transformations = null, $object = null)
    {
        return static::curry2(function (array $transformations, $object) {
            $isObject = is_object($object);
            if ($isObject) {
                $object = clone $object;
            }
            foreach ($transformations as $field => $function) {
                $value = $function(static::_prop($field, $object));
                if ($isObject && ! $object instanceof \ArrayAccess) {
                    $object->{$field} = $value;
                } else {
                    $object[$field] = $value;
                }
            }

            return $object;
        }, func_get_args());
    }

    /**
     * Returns an array containing the parts of a string split by the given delimiter.
     *
     * If the delimiter is an empty string, returns a char array.
     *
     * ```php
     * P::explode('/', 'f/o/o'); // => ['f', 'o', 'o']
     * P::explode('', 'b/a/z'); // => ['b', '/', 'a', '/', 'z']
     * P::explode('.', ''); // => ['']
     * ```
     *
     * @param string $delimiter
     * @param string $string
     *
     * @return callable|string[]
     */
    public static function explode($delimiter = null, $string = null)
    {
        return static::curry2(function (string $delimiter, string $string) {
            return $delimiter === '' ? str_split($string) : explode($delimiter, $string);
        }, func_get_args());
    }

    /**
     * Returns a function that always returns `false`.
     *
     * ```php
     * $false = P::false();
     * $false(); // => false
     * ```
     *
     * @return callable
     */
    public static function false()
    {
        return function () {
            return false;
        };
    }

    /**
     * Returns a new collection containing the items that match the given predicate.
     *
     * The supplied `predicate` receives three arguments: `item`, `index`, `collection`.
     *
     * ```php
     * $gt2 = function ($x) { return $x > 2; };
     * P::filter($gt2, ['foo' => 2, 'bar' => 3, 'baz' => 4]); // => ['bar' => 3, 'baz' => 4]
     * ```
     *
     * @param callable                      $predicate
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function filter($predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            return static::_filter($predicate, $collection);
        }, func_get_args());
    }

    /**
     * Returns the first item of a collection for which the given predicate matches, or null if no match is found.
     *
     * ```php
     * $isPositive = function ($x) { return $x > 0; };
     * P::find($isPositive, [-5, 0, 15, 33, -2]); // => 15
     * ```
     *
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|mixed|null
     */
    public static function find($predicate = null, $collection = null)
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
     * Returns the index of the first item of a collection for which the given predicate matches, or null if no match is found.
     *
     * ```php
     * $isPositive = function ($x) { return $x > 0; };
     * P::findIndex($isPositive, [-5, 0, 15, 33, -2]); // => 2
     * ```
     *
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|int|string|null
     */
    public static function findIndex($predicate = null, $collection = null)
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
     * Returns the last item of a collection for which the given predicate matches, or null if no match is found.
     *
     * ```php
     * $isPositive = function ($x) { return $x > 0; };
     * P::findLast($isPositive, [-5, 0, 15, 33, -2]); // => 33
     * ```
     *
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|mixed|null
     */
    public static function findLast($predicate = null, $collection = null)
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
     * Returns the index of the last item of a collection for which the given predicate matches, or null if no match is found.
     *
     * ```php
     * $isPositive = function ($x) { return $x > 0; };
     * P::findLastIndex($isPositive, [-5, 0, 15, 33, -2]); // => 3
     * ```
     *
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|int|string|null
     */
    public static function findLastIndex($predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            foreach (static::_reverse($collection) as $index => $item) {
                if ($predicate($item)) {
                    return $index;
                }
            }

            return null;
        }, func_get_args());
    }

    /**
     * Returns the first item of a collection, or false if the collection is empty.
     *
     * ```php
     * P::first([5, 8, 9, 13]); // => 5
     * P::first([]); // => false
     * ```
     *
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
     * Returns a list containing the flattened items created by applying the `function` to each item of the `list`.
     *
     * ```php
     * $split = P::unary('str_split');
     * P::flatMap($split, ['abc', 'de']); // => ['a', 'b', 'c', 'd', 'e']
     * $getNeighbors = function ($x) { return [$x - 1, $x, $x + 1]; };
     * P::flatMap($getNeighbors, [1, 2, 3]); // => [0, 1, 2, 1, 2, 3, 2, 3, 4]
     * ```
     *
     * @param callable $function
     * @param array    $list
     *
     * @return callable|array
     */
    public static function flatMap($function = null, $list = null)
    {
        return static::curry2(function (callable $function, array $list) {
            return static::_flatten(static::_map($function, $list), false);
        }, func_get_args());
    }

    /**
     * Returns an array that contains all the items on the `list`, with all arrays flattened.
     *
     * ```php
     * P::flatten([1, [2, 3], [4]]); // => [1, 2, 3, 4]
     * P::flatten([1, [2, [3]], [[4]]]); // => [1, 2, 3, 4]
     * ```
     *
     * @param array $list
     *
     * @return callable|array
     */
    public static function flatten($list = null)
    {
        return static::curry1(function (array $list) {
            return static::_flatten($list, true);
        }, func_get_args());
    }

    /**
     * Returns an array that contains all the items on the `list`, with arrays on the first nesting level flattened.
     *
     * ```php
     * P::flattenLevel([1, [2, 3], [4]]); // => [1, 2, 3, 4]
     * P::flattenLevel([1, [2, [3]], [[4]]]); // => [1, 2, [3], [4]]
     * ```
     *
     * @param array $list
     *
     * @return callable|array
     */
    public static function flattenLevel($list = null)
    {
        return static::curry1(function (array $list) {
            return static::_flatten($list, false);
        }, func_get_args());
    }

    /**
     * Wraps the given function and returns a new function for which the order of the first two parameters is reversed.
     *
     * ```php
     * $sub = function ($x, $y) { return $x - $y; };
     * $flippedSub = P::flip($sub);
     * $flippedSub(20, 30); // => 10
     * ```
     *
     * @param callable $function
     *
     * @return callable
     */
    public static function flip($function = null)
    {
        return static::curry1(function (callable $function) {
            return function ($a, $b, ...$arguments) use ($function) {
                return $function($b, $a, ...$arguments);
            };
        }, func_get_args());
    }

    /**
     * Creates a new map from a list of key-value pairs.
     *
     * ```php
     * P::fromPairs([['a', 'b'], ['c', 'd']]); // => ['a' => 'b', 'c' => 'd']
     * P::fromPairs([[3, 'b'], [5, null]]); // => [3 => 'b', 5 => null]
     * ```
     *
     * @param array|\Traversable|Collection $list
     *
     * @return callable|array|Collection
     */
    public static function fromPairs($list = null)
    {
        return static::curry1(function ($list) {
            if (method_exists($list, 'fromPairs')) {
                return $list->fromPairs();
            }
            $map = [];
            foreach ($list as list($key, $value)) {
                $map[$key] = $value;
            }

            return $map;
        }, func_get_args());
    }

    /**
     * Returns an array of sub collections based on a function that returns the group keys for each item.
     *
     * ```php
     * $firstChar = function ($string) { return $string[0]; };
     * $collection = ['abc', 'cbc', 'cab', 'baa', 'ayb'];
     * P::groupBy($firstChar, $collection); // => ['a' => [0 => 'abc', 4 => 'ayb'], 'c' => [1 => 'cbc', 2 => 'cab'], 'b' => [3 => 'baa']]
     * ```
     *
     * @param callable                      $function
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array[]|Collection[]
     */
    public static function groupBy($function = null, $collection = null)
    {
        return static::curry2(function (callable $function, $collection) {
            if (method_exists($collection, 'groupBy')) {
                return $collection->groupBy($function);
            }

            return static::_reduce(function (array $collections, $item, $key) use ($function) {
                $collections[$function($item)][$key] = $item;

                return $collections;
            }, [], $collection);
        }, func_get_args());
    }

    /**
     * Returns `true` if the first parameter is greater than the second, `false` otherwise.
     *
     * ```php
     * P::gt(1, 2); // => false
     * P::gt(1, 1); // => false
     * P::gt(2, 1); // => true
     * ```
     *
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
     * Returns `true` if the first parameter is greater than or equal to the second, `false` otherwise.
     *
     * ```php
     * P::gte(1, 2); // => false
     * P::gte(1, 1); // => true
     * P::gte(2, 1); // => true
     * ```
     *
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
     * Returns the given parameter.
     *
     * ```php
     * P::identity(1); // => 1
     * P::identity(null); // => null
     * P::identity('abc'); // => 'abc'
     * ```
     *
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
     * Returns a function that applies either the `onTrue` or the `onFalse` function, depending on the result of the `condition` predicate.
     *
     * ```php
     * $addOrSub = P::ifElse(P::lt(0), P::add(-10), P::add(10));
     * $addOrSub(25); // => 15
     * $addOrSub(-3); // => 7
     * ```
     *
     * @param callable $condition
     * @param callable $onTrue
     * @param callable $onFalse
     *
     * @return callable
     */
    public static function ifElse($condition = null, $onTrue = null, $onFalse = null)
    {
        return static::curry3(function (callable $condition, callable $onTrue, callable $onFalse) {
            return function (...$arguments) use ($condition, $onTrue, $onFalse) {
                return $condition(...$arguments) ? $onTrue(...$arguments) : $onFalse(...$arguments);
            };
        }, func_get_args());
    }

    /**
     * Returns a string formed by combining a list of strings using the given glue string.
     *
     * ```php
     * P::implode('/', ['f', 'o', 'o']); // => 'f/o/o'
     * P::implode('.', ['a', 'b', 'cd', '']); // => 'a.b.cd.'
     * P::implode('.', ['']); // => ''
     * ```
     *
     * @param string   $glue
     * @param string[] $strings
     *
     * @return callable|string
     */
    public static function implode($glue = null, $strings = null)
    {
        return static::curry2(function (string $glue, array $strings) {
            return implode($glue, $strings);
        }, func_get_args());
    }

    /**
     * Increments the given number.
     *
     * ```php
     * P::inc(41); // => 42
     * P::inc(-16); // => -15
     * ```
     *
     * @param int|float $number
     *
     * @return callable|int|float
     *
     * @deprecated Since version 0.7, to be removed in 0.8. Use `add(1)` instead.
     */
    public static function inc($number = null)
    {
        return static::curry1(function ($number) {
            return Phamda::add(1, $number);
        }, func_get_args());
    }

    /**
     * Returns the index of the given item in a collection, or `false` if the item is not found.
     *
     * ```php
     * P::indexOf(16, [1, 6, 44, 16, 52]); // => 3
     * P::indexOf(15, [1, 6, 44, 16, 52]); // => false
     * ```
     *
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
     * Returns a function that calls the specified method of a given object.
     *
     * ```php
     * $addDay = P::invoker(1, 'add', new \DateInterval('P1D'));
     * $addDay(new \DateTime('2015-03-15'))->format('Y-m-d'); // => '2015-03-16'
     * $addDay(new \DateTime('2015-03-12'))->format('Y-m-d'); // => '2015-03-13'
     * ```
     *
     * @param int    $arity
     * @param string $method
     * @param mixed  ...$initialArguments
     *
     * @return callable
     */
    public static function invoker($arity = null, $method = null, ...$initialArguments)
    {
        return static::curry2(function (int $arity, string $method, ...$initialArguments) {
            $remainingCount = $arity - count($initialArguments) + 1;

            return static::_curryN($remainingCount, function (...$arguments) use ($method, $initialArguments) {
                $object = array_pop($arguments);

                return $object->{$method}(...array_merge($initialArguments, $arguments));
            });
        }, func_get_args());
    }

    /**
     * Returns `true` if a collection has no elements, `false` otherwise.
     *
     * ```php
     * P::isEmpty([1, 2, 3]); // => false
     * P::isEmpty([0]); // => false
     * P::isEmpty([]); // => true
     * ```
     *
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
     * Return `true` if an object is of the specified class, `false` otherwise.
     *
     * ```php
     * $isDate = P::isInstance(\DateTime::class);
     * $isDate(new \DateTime()); // => true
     * $isDate(new \DateTimeImmutable()); // => false
     * ```
     *
     * @param string $class
     * @param object $object
     *
     * @return callable|bool
     */
    public static function isInstance($class = null, $object = null)
    {
        return static::curry2(function (string $class, $object) {
            return $object instanceof $class;
        }, func_get_args());
    }

    /**
     * Returns the last item of a collection, or false if the collection is empty.
     *
     * ```php
     * P::last([5, 8, 9, 13]); // => 13
     * P::last([]); // => false
     * ```
     *
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
     * Returns `true` if the first parameter is less than the second, `false` otherwise.
     *
     * ```php
     * P::lt(1, 2); // => true
     * P::lt(1, 1); // => false
     * P::lt(2, 1); // => false
     * ```
     *
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
     * Returns `true` if the first parameter is less than or equal to the second, `false` otherwise.
     *
     * ```php
     * P::lte(1, 2); // => true
     * P::lte(1, 1); // => true
     * P::lte(2, 1); // => false
     * ```
     *
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
     * Returns a new collection where values are created from the original collection by calling the supplied function.
     *
     * The supplied `function` receives three arguments: `item`, `index`, `collection`.
     *
     * ```php
     * $square = function ($x) { return $x ** 2; };
     * P::map($square, [1, 2, 3, 4]); // => [1, 4, 9, 16]
     * $keyExp = function ($value, $key) { return $value ** $key; };
     * P::map($keyExp, [1, 2, 3, 4]); // => [1, 2, 9, 64]
     * ```
     *
     * @param callable                      $function
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function map($function = null, $collection = null)
    {
        return static::curry2(function (callable $function, $collection) {
            return static::_map($function, $collection);
        }, func_get_args());
    }

    /**
     * Returns the largest value in the collection.
     *
     * ```php
     * P::max([6, 15, 8, 9, -2, -3]); // => 15
     * P::max(['bar', 'foo', 'baz']); // => 'foo'
     * ```
     *
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
     * Returns the item from a collection for which the supplied function returns the largest value.
     *
     * ```php
     * $getFoo = function ($item) { return $item->foo; };
     * $a = (object) ['baz' => 3, 'bar' => 16, 'foo' => 5];
     * $b = (object) ['baz' => 1, 'bar' => 25, 'foo' => 8];
     * $c = (object) ['baz' => 14, 'bar' => 20, 'foo' => -2];
     * P::maxBy($getFoo, [$a, $b, $c]); // => $b
     * ```
     *
     * @param callable           $getValue
     * @param array|\Traversable $collection
     *
     * @return callable|mixed
     */
    public static function maxBy($getValue = null, $collection = null)
    {
        return static::curry2(function (callable $getValue, $collection) {
            return static::getCompareByResult(Phamda::gt(), $getValue, $collection);
        }, func_get_args());
    }

    /**
     * Returns an array that contains all the values in arrays `a` and `b`.
     *
     * ```php
     * P::merge([1, 2], [3, 4, 5]); // => [1, 2, 3, 4, 5]
     * P::merge(['a', 'b'], ['a', 'b']); // => ['a', 'b', 'a', 'b']
     * ```
     *
     * @param array $a
     * @param array $b
     *
     * @return callable|array
     */
    public static function merge($a = null, $b = null)
    {
        return static::curry2(function (array $a, array $b) {
            foreach ($b as $item) {
                $a[] = $item;
            }

            return $a;
        }, func_get_args());
    }

    /**
     * Returns the smallest value in the collection.
     *
     * ```php
     * P::min([6, 15, 8, 9, -2, -3]); // => -3
     * P::min(['bar', 'foo', 'baz']); // => 'bar'
     * ```
     *
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
     * Returns the item from a collection for which the supplied function returns the smallest value.
     *
     * ```php
     * $getFoo = function ($item) { return $item->foo; };
     * $a = (object) ['baz' => 3, 'bar' => 16, 'foo' => 5];
     * $b = (object) ['baz' => 1, 'bar' => 25, 'foo' => 8];
     * $c = (object) ['baz' => 14, 'bar' => 20, 'foo' => -2];
     * P::minBy($getFoo, [$a, $b, $c]); // => $c
     * ```
     *
     * @param callable           $getValue
     * @param array|\Traversable $collection
     *
     * @return callable|mixed
     */
    public static function minBy($getValue = null, $collection = null)
    {
        return static::curry2(function (callable $getValue, $collection) {
            return static::getCompareByResult(Phamda::lt(), $getValue, $collection);
        }, func_get_args());
    }

    /**
     * Divides two integers and returns the modulo.
     *
     * ```php
     * P::modulo(15, 6); // => 3
     * P::modulo(22, 11); // => 0
     * P::modulo(-23, 6); // => -5
     * ```
     *
     * @param int $x
     * @param int $y
     *
     * @return callable|int
     */
    public static function modulo($x = null, $y = null)
    {
        return static::curry2(function (int $x, int $y) {
            return $x % $y;
        }, func_get_args());
    }

    /**
     * Multiplies two numbers.
     *
     * ```php
     * P::multiply(15, 27); // => 405
     * P::multiply(36, -8); // => -288
     * ```
     *
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
     * Wraps the given function in a function that accepts exactly the given amount of parameters.
     *
     * ```php
     * $add3 = function ($a = 0, $b = 0, $c = 0) { return $a + $b + $c; };
     * $add2 = P::nAry(2, $add3);
     * $add2(27, 15, 33); // => 42
     * $add1 = P::nAry(1, $add3);
     * $add1(27, 15, 33); // => 27
     * ```
     *
     * @param int      $arity
     * @param callable $function
     *
     * @return callable
     */
    public static function nAry($arity = null, $function = null)
    {
        return static::curry2(function (int $arity, callable $function) {
            return function (...$arguments) use ($arity, $function) {
                return $function(...array_slice($arguments, 0, $arity));
            };
        }, func_get_args());
    }

    /**
     * Returns the negation of a number.
     *
     * ```php
     * P::negate(15); // => -15
     * P::negate(-0.7); // => 0.7
     * P::negate(0); // => 0
     * ```
     *
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
     * Returns `true` if no element in the collection matches the predicate, `false` otherwise.
     *
     * ```php
     * $isPositive = function ($x) { return $x > 0; };
     * P::none($isPositive, [1, 2, 0, -5]); // => false
     * P::none($isPositive, [-3, -7, -1, -5]); // => true
     * ```
     *
     * @param callable           $predicate
     * @param array|\Traversable $collection
     *
     * @return callable|bool
     */
    public static function none($predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            return ! Phamda::any($predicate, $collection);
        }, func_get_args());
    }

    /**
     * Wraps a predicate and returns a function that return `true` if the wrapped function returns a falsey value, `false` otherwise.
     *
     * ```php
     * $equal = function ($a, $b) { return $a === $b; };
     * $notEqual = P::not($equal);
     * $notEqual(15, 13); // => true
     * $notEqual(7, 7); // => false
     * ```
     *
     * @param callable $predicate
     *
     * @return callable
     */
    public static function not($predicate = null)
    {
        return static::curry1(function (callable $predicate) {
            return function (...$arguments) use ($predicate) {
                return ! $predicate(...$arguments);
            };
        }, func_get_args());
    }

    /**
     * Wraps the given function and returns a new function that can be called with the remaining parameters.
     *
     * ```php
     * $add = function ($x, $y, $z) { return $x + $y + $z; };
     * $addTen = P::partial($add, 10);
     * $addTen(3, 4); // => 17
     * $addTwenty = P::partial($add, 2, 3, 15);
     * $addTwenty(); // => 20
     * ```
     *
     * @param callable $function
     * @param mixed    ...$initialArguments
     *
     * @return callable
     */
    public static function partial($function = null, ...$initialArguments)
    {
        return static::curry1(function (callable $function, ...$initialArguments) {
            return static::_partialN(static::getArity($function), $function, ...$initialArguments);
        }, func_get_args());
    }

    /**
     * Wraps the given function and returns a new function of fixed arity that can be called with the remaining parameters.
     *
     * ```php
     * $add = function ($x, $y, $z = 0) { return $x + $y + $z; };
     * $addTen = P::partialN(3, $add, 10);
     * $addTwenty = $addTen(10);
     * $addTwenty(5); // => 25
     * ```
     *
     * @param int      $arity
     * @param callable $function
     * @param mixed    ...$initialArguments
     *
     * @return callable
     */
    public static function partialN($arity = null, $function = null, ...$initialArguments)
    {
        return static::curry2(function (int $arity, callable $function, ...$initialArguments) {
            return static::_partialN($arity, $function, ...$initialArguments);
        }, func_get_args());
    }

    /**
     * Returns the items of the original collection divided into two collections based on a predicate function.
     *
     * ```php
     * $isPositive = function ($x) { return $x > 0; };
     * P::partition($isPositive, [4, -16, 7, -3, 2, 88]); // => [[0 => 4, 2 => 7, 4 => 2, 5 => 88], [1 => -16, 3 => -3]]
     * ```
     *
     * @param callable                      $predicate
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array[]|Collection[]
     */
    public static function partition($predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            if (method_exists($collection, 'partition')) {
                return $collection->partition($predicate);
            }

            return static::_reduce(function (array $collections, $item, $key) use ($predicate) {
                $collections[$predicate($item) ? 0 : 1][$key] = $item;

                return $collections;
            }, [[], []], $collection);
        }, func_get_args());
    }

    /**
     * Returns a value found at the given path.
     *
     * ```php
     * P::path(['foo', 'bar'], ['foo' => ['baz' => 26, 'bar' => 15]]); // => 15
     * P::path(['bar', 'baz'], ['bar' => ['baz' => null, 'foo' => 15]]); // => null
     * ```
     *
     * @param array        $path
     * @param array|object $object
     *
     * @return callable|mixed
     */
    public static function path($path = null, $object = null)
    {
        return static::curry2(function (array $path, $object) {
            foreach ($path as $name) {
                $object = static::_prop($name, $object);
            }

            return $object;
        }, func_get_args());
    }

    /**
     * Returns `true` if the given value is found at the specified path, `false` otherwise.
     *
     * ```php
     * P::pathEq(['foo', 'bar'], 44, ['foo' => ['baz' => 26, 'bar' => 15]]); // => false
     * P::pathEq(['foo', 'baz'], 26, ['foo' => ['baz' => 26, 'bar' => 15]]); // => true
     * ```
     *
     * @param array        $path
     * @param mixed        $value
     * @param array|object $object
     *
     * @return callable|bool
     */
    public static function pathEq($path = null, $value = null, $object = null)
    {
        return static::curry3(function (array $path, $value, $object) {
            return Phamda::path($path, $object) === $value;
        }, func_get_args());
    }

    /**
     * Returns a new array, containing only the values that have keys matching the given list.
     *
     * ```php
     * P::pick(['bar', 'fib'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => ['bar' => 'bzz']
     * P::pick(['fob', 'fib'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => []
     * P::pick(['bar', 'foo'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => ['bar' => 'bzz', 'foo' => null]
     * ```
     *
     * @param array $names
     * @param array $item
     *
     * @return callable|array
     */
    public static function pick($names = null, $item = null)
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
     * Returns a new array, containing the values that have keys matching the given list, including keys that are not found in the item.
     *
     * ```php
     * P::pickAll(['bar', 'fib'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => ['bar' => 'bzz', 'fib' => null]
     * P::pickAll(['fob', 'fib'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => ['fob' => null, 'fib' => null]
     * P::pickAll(['bar', 'foo'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => ['bar' => 'bzz', 'foo' => null]
     * ```
     *
     * @param array $names
     * @param array $item
     *
     * @return callable|array
     */
    public static function pickAll($names = null, $item = null)
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
     * Returns a new function that calls each supplied function in turn and passes the result as a parameter to the next function.
     *
     * ```php
     * $add5 = function ($x) { return $x + 5; };
     * $square = function ($x) { return $x ** 2; };
     * $squareAdded = P::pipe($add5, $square);
     * $squareAdded(4); // => 81
     * $hello = function ($target) { return 'Hello ' . $target; };
     * $helloUpper = P::pipe('strtoupper', $hello);
     * $upperHello = P::pipe($hello, 'strtoupper');
     * $helloUpper('world'); // => 'Hello WORLD'
     * $upperHello('world'); // => 'HELLO WORLD'
     * ```
     *
     * @param callable ...$functions
     *
     * @return callable
     */
    public static function pipe(...$functions)
    {
        if (count($functions) < 2) {
            throw InvalidFunctionCompositionException::create();
        }

        return function (...$arguments) use ($functions) {
            $result = null;
            foreach ($functions as $function) {
                $result = $result !== null ? $function($result) : $function(...$arguments);
            }

            return $result;
        };
    }

    /**
     * Returns a new collection, where the items are single properties plucked from the given collection.
     *
     * ```php
     * P::pluck('foo', [['foo' => null, 'bar' => 'bzz', 'baz' => 'bob'], ['foo' => 'fii', 'baz' => 'pob']]); // => [null, 'fii']
     * P::pluck('baz', [['foo' => null, 'bar' => 'bzz', 'baz' => 'bob'], ['foo' => 'fii', 'baz' => 'pob']]); // => ['bob', 'pob']
     * ```
     *
     * @param string                        $name
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function pluck($name = null, $collection = null)
    {
        return static::curry2(function (string $name, $collection) {
            return static::_map(Phamda::prop($name), $collection);
        }, func_get_args());
    }

    /**
     * Return a new collection that contains the given item first and all the items in the given collection.
     *
     * ```php
     * P::prepend('c', ['a', 'b']); // => ['c', 'a', 'b']
     * P::prepend('c', []); // => ['c']
     * P::prepend(['d', 'e'], ['a', 'b']); // => [['d', 'e'], 'a', 'b']
     * ```
     *
     * @param mixed            $item
     * @param array|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function prepend($item = null, $collection = null)
    {
        return static::curry2(function ($item, $collection) {
            if (is_array($collection)) {
                array_unshift($collection, $item);

                return $collection;
            } elseif (method_exists($collection, 'prepend')) {
                return $collection->prepend($item);
            } else {
                $items[] = $item;
                foreach ($collection as $collectionItem) {
                    $items[] = $collectionItem;
                }

                return $items;
            }
        }, func_get_args());
    }

    /**
     * Multiplies a list of numbers.
     *
     * ```php
     * P::product([11, -8, 3]); // => -264
     * P::product([1, 2, 3, 4, 5, 6]); // => 720
     * ```
     *
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
     * Returns the given element of an array or property of an object.
     *
     * ```php
     * P::prop('bar', ['bar' => 'fuz', 'baz' => null]); // => 'fuz'
     * P::prop('baz', ['bar' => 'fuz', 'baz' => null]); // => null
     * ```
     *
     * @param string                    $name
     * @param array|object|\ArrayAccess $object
     *
     * @return callable|mixed
     */
    public static function prop($name = null, $object = null)
    {
        return static::curry2(function (string $name, $object) {
            return static::_prop($name, $object);
        }, func_get_args());
    }

    /**
     * Returns `true` if the specified property has the given value, `false` otherwise.
     *
     * ```php
     * P::propEq('foo', 'bar', ['foo' => 'bar']); // => true
     * P::propEq('foo', 'baz', ['foo' => 'bar']); // => false
     * ```
     *
     * @param string       $name
     * @param mixed        $value
     * @param array|object $object
     *
     * @return callable|bool
     */
    public static function propEq($name = null, $value = null, $object = null)
    {
        return static::curry3(function (string $name, $value, $object) {
            return static::_prop($name, $object) === $value;
        }, func_get_args());
    }

    /**
     * Returns a value accumulated by calling the given function for each element of the collection.
     *
     * The supplied `function` receives four arguments: `previousValue`, `item`, `index`, `collection`.
     *
     * ```php
     * $concat = function ($x, $y) { return $x . $y; };
     * P::reduce($concat, 'foo', ['bar', 'baz']); // => 'foobarbaz'
     * ```
     *
     * @param callable           $function
     * @param mixed              $initial
     * @param array|\Traversable $collection
     *
     * @return callable|mixed
     */
    public static function reduce($function = null, $initial = null, $collection = null)
    {
        return static::curry3(function (callable $function, $initial, $collection) {
            return static::_reduce($function, $initial, $collection);
        }, func_get_args());
    }

    /**
     * Returns a value accumulated by calling the given function for each element of the collection in reverse order.
     *
     * The supplied `function` receives four arguments: `previousValue`, `item`, `index`, `collection`.
     *
     * ```php
     * $concat = function ($accumulator, $value, $key) { return $accumulator . $key . $value; };
     * P::reduceRight($concat, 'no', ['foo' => 'bar', 'fiz' => 'buz']); // => 'nofizbuzfoobar'
     * ```
     *
     * @param callable           $function
     * @param mixed              $initial
     * @param array|\Traversable $collection
     *
     * @return callable|mixed
     */
    public static function reduceRight($function = null, $initial = null, $collection = null)
    {
        return static::curry3(function (callable $function, $initial, $collection) {
            return static::_reduce($function, $initial, static::_reverse($collection));
        }, func_get_args());
    }

    /**
     * Returns a new collection containing the items that do not match the given predicate.
     *
     * The supplied `predicate` receives three arguments: `item`, `index`, `collection`.
     *
     * ```php
     * $isEven = function ($x) { return $x % 2 === 0; };
     * P::reject($isEven, [1, 2, 3, 4]); // => [0 => 1, 2 => 3]
     * ```
     *
     * @param callable                      $predicate
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function reject($predicate = null, $collection = null)
    {
        return static::curry2(function (callable $predicate, $collection) {
            return static::_filter(Phamda::not($predicate), $collection);
        }, func_get_args());
    }

    /**
     * Returns a new collection where the items are in a reverse order.
     *
     * ```php
     * P::reverse([3, 2, 1]); // => [2 => 1, 1 => 2, 0 => 3]
     * P::reverse([22, 4, 16, 5]); // => [3 => 5, 2 => 16, 1 => 4, 0 => 22]
     * P::reverse([]); // => []
     * ```
     *
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function reverse($collection = null)
    {
        return static::curry1(function ($collection) {
            return static::_reverse($collection);
        }, func_get_args());
    }

    /**
     * Returns a new collection, containing the items of the original from index `start` (inclusive) to index `end` (exclusive).
     *
     * ```php
     * P::slice(2, 6, [1, 2, 3, 4, 5, 6, 7, 8, 9]); // => [3, 4, 5, 6]
     * P::slice(0, 3, [1, 2, 3, 4, 5, 6, 7, 8, 9]); // => [1, 2, 3]
     * P::slice(7, 11, [1, 2, 3, 4, 5, 6, 7, 8, 9]); // => [8, 9]
     * ```
     *
     * @param int                           $start
     * @param int                           $end
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function slice($start = null, $end = null, $collection = null)
    {
        return static::curry3(function (int $start, int $end, $collection) {
            return static::_slice($start, $end, $collection);
        }, func_get_args());
    }

    /**
     * Returns a new collection sorted by the given comparator function.
     *
     * ```php
     * $sub = function ($a, $b) { return $a - $b; };
     * P::sort($sub, [3, 2, 4, 1]); // => [1, 2, 3, 4]
     * ```
     *
     * @param callable                      $comparator
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function sort($comparator = null, $collection = null)
    {
        return static::curry2(function (callable $comparator, $collection) {
            return static::_sort($comparator, $collection);
        }, func_get_args());
    }

    /**
     * Returns a new collection sorted by comparing the values provided by calling the given function for each item.
     *
     * ```php
     * $getFoo = function ($a) { return $a['foo']; };
     * $collection = [['foo' => 16, 'bar' => 3], ['foo' => 5, 'bar' => 42], ['foo' => 11, 'bar' => 7]];
     * P::sortBy($getFoo, $collection); // => [['foo' => 5, 'bar' => 42], ['foo' => 11, 'bar' => 7], ['foo' => 16, 'bar' => 3]]
     * ```
     *
     * @param callable                      $function
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function sortBy($function = null, $collection = null)
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
     * Returns the first index of a substring in a string, or `false` if the substring is not found.
     *
     * ```php
     * P::stringIndexOf('def', 'abcdefdef'); // => 3
     * P::stringIndexOf('a', 'abcdefgh'); // => 0
     * P::stringIndexOf('ghi', 'abcdefgh'); // => false
     * ```
     *
     * @param string $substring
     * @param string $string
     *
     * @return callable|int|false
     */
    public static function stringIndexOf($substring = null, $string = null)
    {
        return static::curry2(function (string $substring, string $string) {
            return strpos($string, $substring);
        }, func_get_args());
    }

    /**
     * Returns the last index of a substring in a string, or `false` if the substring is not found.
     *
     * ```php
     * P::stringLastIndexOf('def', 'abcdefdef'); // => 6
     * P::stringLastIndexOf('a', 'abcdefgh'); // => 0
     * P::stringLastIndexOf('ghi', 'abcdefgh'); // => false
     * ```
     *
     * @param string $substring
     * @param string $string
     *
     * @return callable|int|false
     */
    public static function stringLastIndexOf($substring = null, $string = null)
    {
        return static::curry2(function (string $substring, string $string) {
            return strrpos($string, $substring);
        }, func_get_args());
    }

    /**
     * Returns a substring of the original string between given indexes.
     *
     * ```php
     * P::substring(2, 5, 'foobarbaz'); // => 'oba'
     * P::substring(4, 8, 'foobarbaz'); // => 'arba'
     * P::substring(3, -2, 'foobarbaz'); // => 'barb'
     * ```
     *
     * @param int    $start
     * @param int    $end
     * @param string $string
     *
     * @return callable|string
     */
    public static function substring($start = null, $end = null, $string = null)
    {
        return static::curry3(function (int $start, int $end, string $string) {
            return substr($string, $start, $end >= 0 ? $end - $start : $end);
        }, func_get_args());
    }

    /**
     * Returns a substring of the original string starting from the given index.
     *
     * ```php
     * P::substringFrom(5, 'foobarbaz'); // => 'rbaz'
     * P::substringFrom(1, 'foobarbaz'); // => 'oobarbaz'
     * P::substringFrom(-2, 'foobarbaz'); // => 'az'
     * ```
     *
     * @param int    $start
     * @param string $string
     *
     * @return callable|string
     */
    public static function substringFrom($start = null, $string = null)
    {
        return static::curry2(function (int $start, string $string) {
            return substr($string, $start);
        }, func_get_args());
    }

    /**
     * Returns a substring of the original string ending before the given index.
     *
     * ```php
     * P::substringTo(5, 'foobarbaz'); // => 'fooba'
     * P::substringTo(8, 'foobarbaz'); // => 'foobarba'
     * P::substringTo(-3, 'foobarbaz'); // => 'foobar'
     * ```
     *
     * @param int    $end
     * @param string $string
     *
     * @return callable|string
     */
    public static function substringTo($end = null, $string = null)
    {
        return static::curry2(function (int $end, string $string) {
            return substr($string, 0, $end);
        }, func_get_args());
    }

    /**
     * Subtracts two numbers.
     *
     * ```php
     * P::subtract(15, 27); // => -12
     * P::subtract(36, -8); // => 44
     * ```
     *
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
     * Adds together a list of numbers.
     *
     * ```php
     * P::sum([1, 2, 3, 4, 5, 6]); // => 21
     * P::sum([11, 0, 2, -4, 7]); // => 16
     * ```
     *
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
     * Returns a new collection that contains all the items from the original `collection` except the first.
     *
     * ```php
     * P::tail([2, 4, 6, 3]); // => [4, 6, 3]
     * ```
     *
     * @param array|\Traversable|Collection $collection
     *
     * @return callable|array|Collection
     */
    public static function tail($collection = null)
    {
        return static::curry1(function ($collection) {
            return static::_slice(1, null, $collection);
        }, func_get_args());
    }

    /**
     * Calls the provided function with the given value as a parameter and returns the value.
     *
     * ```php
     * $addDay = function (\DateTime $date) { $date->add(new \DateInterval('P1D')); };
     * $date = new \DateTime('2015-03-15');
     * P::tap($addDay, $date); // => $date
     * $date->format('Y-m-d'); // => '2015-03-16'
     * ```
     *
     * @param callable $function
     * @param mixed    $object
     *
     * @return callable|mixed
     */
    public static function tap($function = null, $object = null)
    {
        return static::curry2(function (callable $function, $object) {
            $function($object);

            return $object;
        }, func_get_args());
    }

    /**
     * Calls the provided function the specified number of times and returns the results in an array.
     *
     * ```php
     * $double = function ($number) { return $number * 2; };
     * P::times($double, 5); // => [0, 2, 4, 6, 8]
     * ```
     *
     * @param callable $function
     * @param int      $count
     *
     * @return callable|array
     */
    public static function times($function = null, $count = null)
    {
        return static::curry2(function (callable $function, int $count) {
            return static::_map($function, range(0, $count - 1));
        }, func_get_args());
    }

    /**
     * Creates a new list of key-value pairs from a map.
     *
     * ```php
     * P::toPairs(['a' => 'b', 'c' => 'd']); // => [['a', 'b'], ['c', 'd']]
     * P::toPairs([3 => 'b', 5 => null]); // => [[3, 'b'], [5, null]]
     * ```
     *
     * @param array|\Traversable|Collection $map
     *
     * @return callable|array|Collection
     */
    public static function toPairs($map = null)
    {
        return static::curry1(function ($map) {
            if (method_exists($map, 'toPairs')) {
                return $map->toPairs();
            }
            $list = [];
            foreach ($map as $key => $value) {
                $list[] = [$key, $value];
            }

            return $list;
        }, func_get_args());
    }

    /**
     * Returns a function that always returns `true`.
     *
     * ```php
     * $true = P::true();
     * $true(); // => true
     * ```
     *
     * @return callable
     */
    public static function true()
    {
        return function () {
            return true;
        };
    }

    /**
     * Wraps the given function in a function that accepts exactly one parameter.
     *
     * ```php
     * $add2 = function ($a = 0, $b = 0) { return $a + $b; };
     * $add1 = P::nAry(1, $add2);
     * $add1(27, 15); // => 27
     * ```
     *
     * @param callable $function
     *
     * @return callable
     */
    public static function unary($function = null)
    {
        return static::curry1(function (callable $function) {
            return function ($a) use ($function) {
                return $function($a);
            };
        }, func_get_args());
    }

    /**
     * Calls the `function` using the given `arguments` as a single array list argument.
     *
     * Effectively creates an variadic function from a unary function.
     *
     * ```php
     * $concat = function (array $strings) { return implode(' ', $strings); };
     * P::unapply($concat, 'foo', 'ba', 'rba'); // => 'foo ba rba'
     * ```
     *
     * @param callable $function
     * @param mixed    ...$arguments
     *
     * @return callable|mixed
     */
    public static function unapply($function = null, ...$arguments)
    {
        return static::curry2(function (callable $function, ...$arguments) {
            return $function($arguments);
        }, func_get_args());
    }

    /**
     * Returns true if the given object matches the specification.
     *
     * ```php
     * P::where(['a' => 15, 'b' => 16], ['a' => 15, 'b' => 42, 'c' => 88, 'd' => -10]); // => false
     * P::where(['a' => 15, 'b' => 16], ['a' => 15, 'b' => 16, 'c' => -20, 'd' => 77]); // => true
     * ```
     *
     * @param array        $specification
     * @param array|object $object
     *
     * @return callable|mixed
     */
    public static function where($specification = null, $object = null)
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
     * Returns a new array of value pairs from the values of the given arrays with matching keys.
     *
     * ```php
     * P::zip([1, 2, 3], [4, 5, 6]); // => [[1, 4], [2, 5], [3, 6]]
     * P::zip(['a' => 1, 'b' => 2], ['a' => 3, 'c' => 4]); // => ['a' => [1, 3]]
     * P::zip([1, 2, 3], []); // => []
     * ```
     *
     * @param array $a
     * @param array $b
     *
     * @return callable|array
     */
    public static function zip($a = null, $b = null)
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
     * Returns a new array of values created by calling the given function with the matching values of the given arrays.
     *
     * ```php
     * $sum = function ($x, $y) { return $x + $y; };
     * P::zipWith($sum, [1, 2, 3], [5, 6]); // => [6, 8]
     * ```
     *
     * @param callable $function
     * @param array    $a
     * @param array    $b
     *
     * @return callable|array
     */
    public static function zipWith($function = null, $a = null, $b = null)
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
