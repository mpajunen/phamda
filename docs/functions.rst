Phamda functions
================

Currently included functions (110):



_
-
``Placeholder Phamda::_()``

Returns a placeholder to be used with curried functions.

.. code:: php

    $sub10 = Phamda::subtract(Phamda::_(), 10);
    $sub10(52); // => 42


add
---
``int|float Phamda::add(int|float $x, int|float $y)``

Adds two numbers.

.. code:: php

    Phamda::add(15, 27); // => 42
    Phamda::add(36, -8); // => 28


all
---
``bool Phamda::all(callable $predicate, array|\Traversable $collection)``

Returns ``true`` if all elements of the collection match the predicate, ``false`` otherwise.

.. code:: php

    $isPositive = function ($x) { return $x > 0; };
    Phamda::all($isPositive, [1, 2, 0, -5]); // => false
    Phamda::all($isPositive, [1, 2, 1, 11]); // => true


allPass
-------
``callable Phamda::allPass(callable[] $predicates)``

Creates a single predicate from a list of predicates that returns ``true`` when all the predicates match, ``false`` otherwise.

.. code:: php

    $isEven = function ($x) { return $x % 2 === 0; };
    $isPositive = function ($x) { return $x > 0; };
    $isEvenAndPositive = Phamda::allPass([$isEven, $isPositive]);
    $isEvenAndPositive(5); // => false
    $isEvenAndPositive(-4); // => false
    $isEvenAndPositive(6); // => true


always
------
``callable Phamda::always(mixed $value)``

Returns a function that always returns the passed value.

.. code:: php

    $alwaysFoo = Phamda::always('foo');
    $alwaysFoo(); // => 'foo'


any
---
``bool Phamda::any(callable $predicate, array|\Traversable $collection)``

Returns ``true`` if any element of the collection matches the predicate, ``false`` otherwise.

.. code:: php

    $isPositive = function ($x) { return $x > 0; };
    Phamda::any($isPositive, [1, 2, 0, -5]); // => true
    Phamda::any($isPositive, [-3, -7, -1, -5]); // => false


anyPass
-------
``callable Phamda::anyPass(callable[] $predicates)``

Creates a single predicate from a list of predicates that returns ``true`` when any of the predicates matches, ``false`` otherwise.

.. code:: php

    $isEven = function ($x) { return $x % 2 === 0; };
    $isPositive = function ($x) { return $x > 0; };
    $isEvenOrPositive = Phamda::anyPass([$isEven, $isPositive]);
    $isEvenOrPositive(5); // => true
    $isEvenOrPositive(-4); // => true
    $isEvenOrPositive(-3); // => false


append
------
``array|Collection Phamda::append(mixed $item, array|Collection $collection)``

Return a new collection that contains all the items in the given collection and the given item last.

.. code:: php

    Phamda::append('c', ['a', 'b']); // => ['a', 'b', 'c']
    Phamda::append('c', []); // => ['c']
    Phamda::append(['d', 'e'], ['a', 'b']); // => ['a', 'b', ['d', 'e']]


apply
-----
``mixed Phamda::apply(callable $function, array $arguments)``

Calls the ``function`` using the values of the given ``arguments`` list as positional arguments.

Effectively creates an unary function from a variadic function.

.. code:: php

    $concat3 = function ($a, $b, $c) { return $a . $b . $c; };
    Phamda::apply($concat3, ['foo', 'ba', 'rba']); // => 'foobarba'


assoc
-----
``array|object Phamda::assoc(string $property, mixed $value, array|object $object)``

Returns a new array or object, setting the given value to the specified property.

.. code:: php

    Phamda::assoc('bar', 3, ['foo' => 1]); // => ['foo' => 1, 'bar' => 3]
    Phamda::assoc('bar', 3, ['foo' => 1, 'bar' => 2]); // => ['foo' => 1, 'bar' => 3]
    Phamda::assoc('foo', null, ['foo' => 15, 'bar' => 7]); // => ['foo' => null, 'bar' => 7]


assocPath
---------
``array|object Phamda::assocPath(array $path, mixed $value, array|object $object)``

Returns a new array or object, setting the given value to the property specified by the path.

.. code:: php

    Phamda::assocPath(['bar'], 3, ['foo' => 1, 'bar' => 2]); // => ['foo' => 1, 'bar' => 3]
    Phamda::assocPath(['bar', 'baz'], 4, ['foo' => 1, 'bar' => []]); // => ['foo' => 1, 'bar' => ['baz' => 4]]


binary
------
``callable Phamda::binary(callable $function)``

Wraps the given function in a function that accepts exactly two parameters.

.. code:: php

    $add3 = function ($a = 0, $b = 0, $c = 0) { return $a + $b + $c; };
    $add2 = Phamda::binary($add3);
    $add2(27, 15, 33); // => 42


both
----
``callable Phamda::both(callable $a, callable $b)``

Returns a function that returns ``true`` when both of the predicates match, ``false`` otherwise.

.. code:: php

    $lt = function ($x, $y) { return $x < $y; };
    $arePositive = function ($x, $y) { return $x > 0 && $y > 0; };
    $test = Phamda::both($lt, $arePositive);
    $test(9, 4); // => false
    $test(-3, 11); // => false
    $test(5, 17); // => true


cast
----
``mixed Phamda::cast(string $type, mixed $value)``

Return the given ``value`` cast to the given ``type``.

.. code:: php

    Phamda::cast('string', 3); // => '3'
    Phamda::cast('int', 4.55); // => 4


clone_
------
``mixed Phamda::clone_(object $object)``

Clones an object.




comparator
----------
``callable Phamda::comparator(callable $predicate)``

Creates a comparator function from a function that returns whether the first argument is less than the second.

.. code:: php

    $lt = function ($x, $y) { return $x < $y; };
    $compare = Phamda::comparator($lt);
    $compare(5, 6); // => -1
    $compare(6, 5); // => 1
    $compare(5, 5); // => 0


compose
-------
``callable Phamda::compose(callable ... $functions)``

Returns a new function that calls each supplied function in turn in reverse order and passes the result as a parameter to the next function.

.. code:: php

    $add5 = function ($x) { return $x + 5; };
    $square = function ($x) { return $x ** 2; };
    $addToSquared = Phamda::compose($add5, $square);
    $addToSquared(4); // => 21
    $hello = function ($target) { return 'Hello ' . $target; };
    $helloUpper = Phamda::compose($hello, 'strtoupper');
    $upperHello = Phamda::compose('strtoupper', $hello);
    $helloUpper('world'); // => 'Hello WORLD'
    $upperHello('world'); // => 'HELLO WORLD'


concat
------
``string Phamda::concat(string $a, string $b)``

Returns a string concatenated of ``a`` and ``b``.

.. code:: php

    Phamda::concat('ab', 'cd'); // => 'abcd'
    Phamda::concat('abc', ''); // => 'abc'


construct
---------
``object Phamda::construct(string $class, mixed ... $initialArguments)``

Wraps the constructor of the given class to a function.

.. code:: php

    $date = Phamda::construct(\DateTime::class, '2015-03-15');
    $date->format('Y-m-d'); // => '2015-03-15'


constructN
----------
``object Phamda::constructN(int $arity, string $class, mixed ... $initialArguments)``

Wraps the constructor of the given class to a function of specified arity.

.. code:: php

    $construct = Phamda::constructN(1, \DateTime::class);
    $construct('2015-03-15')->format('Y-m-d'); // => '2015-03-15'


contains
--------
``bool Phamda::contains(mixed $value, array|\Traversable $collection)``

Returns ``true`` if the specified item is found in the collection, ``false`` otherwise.

.. code:: php

    Phamda::contains('a', ['a', 'b', 'c', 'e']); // => true
    Phamda::contains('d', ['a', 'b', 'c', 'e']); // => false


curry
-----
``callable Phamda::curry(callable $function, mixed ... $initialArguments)``

Wraps the given function to a function that returns a new function until all required parameters are given.

.. code:: php

    $add = function ($x, $y, $z) { return $x + $y + $z; };
    $addHundred = Phamda::curry($add, 100);
    $addHundred(20, 3); // => 123


curryN
------
``callable Phamda::curryN(int $length, callable $function, mixed ... $initialArguments)``

Wraps the given function to a function of specified arity that returns a new function until all required parameters are given.

.. code:: php

    $add = function ($x, $y, $z = 0) { return $x + $y + $z; };
    $addTen = Phamda::curryN(3, $add, 10);
    $addTen(10, 3); // => 23
    $addTwenty = $addTen(10);
    $addTwenty(5); // => 25


dec
---
``int|float Phamda::dec(int|float $number)``

Decrements the given number.

.. code:: php

    Phamda::dec(43); // => 42
    Phamda::dec(-14); // => -15


defaultTo
---------
``mixed Phamda::defaultTo(mixed $default, mixed $value)``

Returns the default argument if the value argument is ``null``.

.. code:: php

    Phamda::defaultTo(22, 15); // => 15
    Phamda::defaultTo(42, null); // => 42
    Phamda::defaultTo(15, false); // => false


divide
------
``int|float Phamda::divide(int|float $x, int|float $y)``

Divides two numbers.

.. code:: php

    Phamda::divide(55, 11); // => 5
    Phamda::divide(48, -8); // => -6


each
----
``array|\Traversable|Collection Phamda::each(callable $function, array|\Traversable|Collection $collection)``

Calls the given function for each element in the collection and returns the original collection.

The supplied ``function`` receives one argument: ``item``.

.. code:: php

    $date = new \DateTime('2015-02-02');
    $addDays = function ($number) use ($date) { $date->modify("+{$number} days"); };
    Phamda::each($addDays, [3, 6, 2]);
    $date->format('Y-m-d'); // => '2015-02-13'


eachIndexed
-----------
``array|\Traversable|Collection Phamda::eachIndexed(callable $function, array|\Traversable|Collection $collection)``

Calls the given function for each element in the collection and returns the original collection.

Like ``each``, but the supplied ``function`` receives three arguments: ``item``, ``index``, ``collection``.

.. code:: php

    $date = new \DateTime('2015-02-02');
    $addCalendar = function ($number, $type) use ($date) { $date->modify("+{$number} {$type}"); };
    Phamda::eachIndexed($addCalendar, ['months' => 3, 'weeks' => 6, 'days' => 2]);
    $date->format('Y-m-d'); // => '2015-06-15'


either
------
``callable Phamda::either(callable $a, callable $b)``

Returns a function that returns ``true`` when either of the predicates matches, ``false`` otherwise.

.. code:: php

    $lt = function ($x, $y) { return $x < $y; };
    $arePositive = function ($x, $y) { return $x > 0 && $y > 0; };
    $test = Phamda::either($lt, $arePositive);
    $test(-5, -16); // => false
    $test(-3, 11); // => true
    $test(17, 3); // => true


eq
--
``bool Phamda::eq(mixed $x, mixed $y)``

Return true when the arguments are strictly equal.

.. code:: php

    Phamda::eq('a', 'a'); // => true
    Phamda::eq('a', 'b'); // => false
    Phamda::eq(null, null); // => true


evolve
------
``array|object Phamda::evolve(callable[] $transformations, array|object|\ArrayAccess $object)``

Returns a new object or array containing all the fields of the original ``object``, using given ``transformations``.

.. code:: php

    $object = ['foo' => 'bar', 'fiz' => 'buz'];
    Phamda::evolve(['foo' => 'strtoupper'], $object); // => ['foo' => 'BAR', 'fiz' => 'buz']


explode
-------
``string[] Phamda::explode(string $delimiter, string $string)``

Returns an array containing the parts of a string split by the given delimiter.

.. code:: php

    Phamda::explode('/', 'f/o/o'); // => ['f', 'o', 'o']
    Phamda::explode('.', 'a.b.cd.'); // => ['a', 'b', 'cd', '']
    Phamda::explode('.', ''); // => ['']


false
-----
``callable Phamda::false()``

Returns a function that always returns ``false``.

.. code:: php

    $false = Phamda::false();
    $false(); // => false


filter
------
``array|Collection Phamda::filter(callable $predicate, array|\Traversable|Collection $collection)``

Returns a new collection containing the items that match the given predicate.

The supplied ``predicate`` receives one argument: ``item``.

.. code:: php

    $gt2 = function ($x) { return $x > 2; };
    Phamda::filter($gt2, ['foo' => 2, 'bar' => 3, 'baz' => 4]); // => ['bar' => 3, 'baz' => 4]


filterIndexed
-------------
``array|Collection Phamda::filterIndexed(callable $predicate, array|\Traversable|Collection $collection)``

Returns a new collection containing the items that match the given predicate.

Like ``filter``, but the supplied ``predicate`` receives three arguments: ``item``, ``index``, ``collection``.

.. code:: php

    $smallerThanNext = function ($value, $key, $list) { return isset($list[$key + 1]) ? $value < $list[$key + 1] : false; };
    Phamda::filterIndexed($smallerThanNext, [3, 6, 2, 19]); // => [0 => 3, 2 => 2]


find
----
``mixed|null Phamda::find(callable $predicate, array|\Traversable $collection)``

Returns the first item of a collection for which the given predicate matches, or null if no match is found.

.. code:: php

    $isPositive = function ($x) { return $x > 0; };
    Phamda::find($isPositive, [-5, 0, 15, 33, -2]); // => 15


findIndex
---------
``int|string|null Phamda::findIndex(callable $predicate, array|\Traversable $collection)``

Returns the index of the first item of a collection for which the given predicate matches, or null if no match is found.

.. code:: php

    $isPositive = function ($x) { return $x > 0; };
    Phamda::findIndex($isPositive, [-5, 0, 15, 33, -2]); // => 2


findLast
--------
``mixed|null Phamda::findLast(callable $predicate, array|\Traversable $collection)``

Returns the last item of a collection for which the given predicate matches, or null if no match is found.

.. code:: php

    $isPositive = function ($x) { return $x > 0; };
    Phamda::findLast($isPositive, [-5, 0, 15, 33, -2]); // => 33


findLastIndex
-------------
``int|string|null Phamda::findLastIndex(callable $predicate, array|\Traversable $collection)``

Returns the index of the last item of a collection for which the given predicate matches, or null if no match is found.

.. code:: php

    $isPositive = function ($x) { return $x > 0; };
    Phamda::findLastIndex($isPositive, [-5, 0, 15, 33, -2]); // => 3


first
-----
``mixed Phamda::first(array|\Traversable|Collection $collection)``

Returns the first item of a collection, or false if the collection is empty.

.. code:: php

    Phamda::first([5, 8, 9, 13]); // => 5
    Phamda::first([]); // => false


flatMap
-------
``array Phamda::flatMap(callable $function, array $list)``

Returns a list containing the flattened items created by applying the ``function`` to each item of the ``list``.

.. code:: php

    Phamda::flatMap('str_split', ['abc', 'de']); // => ['a', 'b', 'c', 'd', 'e']


flatten
-------
``array Phamda::flatten(array $list)``

Returns an array that contains all the items on the ``list``, with all arrays flattened.

.. code:: php

    Phamda::flatten([1, [2, 3], [4]]); // => [1, 2, 3, 4]
    Phamda::flatten([1, [2, [3]], [[4]]]); // => [1, 2, 3, 4]


flattenLevel
------------
``array Phamda::flattenLevel(array $list)``

Returns an array that contains all the items on the ``list``, with arrays on the first nesting level flattened.

.. code:: php

    Phamda::flattenLevel([1, [2, 3], [4]]); // => [1, 2, 3, 4]
    Phamda::flattenLevel([1, [2, [3]], [[4]]]); // => [1, 2, [3], [4]]


flip
----
``callable Phamda::flip(callable $function)``

Wraps the given function and returns a new function for which the order of the first two parameters is reversed.

.. code:: php

    $sub = function ($x, $y) { return $x - $y; };
    $flippedSub = Phamda::flip($sub);
    $flippedSub(20, 30); // => 10


groupBy
-------
``array[]|Collection[] Phamda::groupBy(callable $function, array|\Traversable|Collection $collection)``

Returns an array of sub collections based on a function that returns the group keys for each item.

.. code:: php

    $firstChar = function ($string) { return $string[0]; };
    $collection = ['abc', 'cbc', 'cab', 'baa', 'ayb'];
    Phamda::groupBy($firstChar, $collection); // => ['a' => [0 => 'abc', 4 => 'ayb'], 'c' => [1 => 'cbc', 2 => 'cab'], 'b' => [3 => 'baa']]


gt
--
``bool Phamda::gt(mixed $x, mixed $y)``

Returns ``true`` if the first parameter is greater than the second, ``false`` otherwise.

.. code:: php

    Phamda::gt(1, 2); // => false
    Phamda::gt(1, 1); // => false
    Phamda::gt(2, 1); // => true


gte
---
``bool Phamda::gte(mixed $x, mixed $y)``

Returns ``true`` if the first parameter is greater than or equal to the second, ``false`` otherwise.

.. code:: php

    Phamda::gte(1, 2); // => false
    Phamda::gte(1, 1); // => true
    Phamda::gte(2, 1); // => true


identity
--------
``mixed Phamda::identity(mixed $x)``

Returns the given parameter.

.. code:: php

    Phamda::identity(1); // => 1
    Phamda::identity(null); // => null
    Phamda::identity('abc'); // => 'abc'


ifElse
------
``callable Phamda::ifElse(callable $condition, callable $onTrue, callable $onFalse)``

Returns a function that applies either the ``onTrue`` or the ``onFalse`` function, depending on the result of the ``condition`` predicate.

.. code:: php

    $addOrSub = Phamda::ifElse(Phamda::lt(0), Phamda::add(-10), Phamda::add(10));
    $addOrSub(25); // => 15
    $addOrSub(-3); // => 7


implode
-------
``string Phamda::implode(string $glue, string[] $strings)``

Returns a string formed by combining a list of strings using the given glue string.

.. code:: php

    Phamda::implode('/', ['f', 'o', 'o']); // => 'f/o/o'
    Phamda::implode('.', ['a', 'b', 'cd', '']); // => 'a.b.cd.'
    Phamda::implode('.', ['']); // => ''


inc
---
``int|float Phamda::inc(int|float $number)``

Increments the given number.

.. code:: php

    Phamda::inc(41); // => 42
    Phamda::inc(-16); // => -15


indexOf
-------
``int|string|false Phamda::indexOf(mixed $item, array|\Traversable $collection)``

Returns the index of the given item in a collection, or ``false`` if the item is not found.

.. code:: php

    Phamda::indexOf(16, [1, 6, 44, 16, 52]); // => 3
    Phamda::indexOf(15, [1, 6, 44, 16, 52]); // => false


invoker
-------
``callable Phamda::invoker(int $arity, string $method, mixed ... $initialArguments)``

Returns a function that calls the specified method of a given object.

.. code:: php

    $addDay = Phamda::invoker(1, 'add', new \DateInterval('P1D'));
    $addDay(new \DateTime('2015-03-15'))->format('Y-m-d'); // => '2015-03-16'
    $addDay(new \DateTime('2015-03-12'))->format('Y-m-d'); // => '2015-03-13'


isEmpty
-------
``bool Phamda::isEmpty(array|\Traversable|Collection $collection)``

Returns ``true`` if a collection has no elements, ``false`` otherwise.

.. code:: php

    Phamda::isEmpty([1, 2, 3]); // => false
    Phamda::isEmpty([0]); // => false
    Phamda::isEmpty([]); // => true


isInstance
----------
``bool Phamda::isInstance(string $class, object $object)``

Return ``true`` if an object is of the specified class, ``false`` otherwise.

.. code:: php

    $isDate = Phamda::isInstance(\DateTime::class);
    $isDate(new \DateTime()); // => true
    $isDate(new \DateTimeImmutable()); // => false


last
----
``mixed Phamda::last(array|\Traversable|Collection $collection)``

Returns the last item of a collection, or false if the collection is empty.

.. code:: php

    Phamda::last([5, 8, 9, 13]); // => 13
    Phamda::last([]); // => false


lt
--
``bool Phamda::lt(mixed $x, mixed $y)``

Returns ``true`` if the first parameter is less than the second, ``false`` otherwise.

.. code:: php

    Phamda::lt(1, 2); // => true
    Phamda::lt(1, 1); // => false
    Phamda::lt(2, 1); // => false


lte
---
``bool Phamda::lte(mixed $x, mixed $y)``

Returns ``true`` if the first parameter is less than or equal to the second, ``false`` otherwise.

.. code:: php

    Phamda::lte(1, 2); // => true
    Phamda::lte(1, 1); // => true
    Phamda::lte(2, 1); // => false


map
---
``array|Collection Phamda::map(callable $function, array|\Traversable|Collection $collection)``

Returns a new collection where values are created from the original collection by calling the supplied function.

The supplied ``function`` receives one argument: ``item``.

.. code:: php

    $square = function ($x) { return $x ** 2; };
    Phamda::map($square, [1, 2, 3, 4]); // => [1, 4, 9, 16]


mapIndexed
----------
``array|Collection Phamda::mapIndexed(callable $function, array|\Traversable|Collection $collection)``

Returns a new collection where values are created from the original collection by calling the supplied function.

Like ``map``, but the supplied ``function`` receives three arguments: ``item``, ``index``, ``collection``.

.. code:: php

    $keyExp = function ($value, $key) { return $value ** $key; };
    Phamda::mapIndexed($keyExp, [1, 2, 3, 4]); // => [1, 2, 9, 64]


max
---
``mixed Phamda::max(array|\Traversable $collection)``

Returns the largest value in the collection.

.. code:: php

    Phamda::max([6, 15, 8, 9, -2, -3]); // => 15
    Phamda::max(['bar', 'foo', 'baz']); // => 'foo'


maxBy
-----
``mixed Phamda::maxBy(callable $getValue, array|\Traversable $collection)``

Returns the item from a collection for which the supplied function returns the largest value.

.. code:: php

    $getFoo = function ($item) { return $item->foo; };
    $a = (object) ['baz' => 3, 'bar' => 16, 'foo' => 5];
    $b = (object) ['baz' => 1, 'bar' => 25, 'foo' => 8];
    $c = (object) ['baz' => 14, 'bar' => 20, 'foo' => -2];
    Phamda::maxBy($getFoo, [$a, $b, $c]); // => $b


merge
-----
``array Phamda::merge(array $a, array $b)``

Returns an array that contains all the values in arrays ``a`` and ``b``.

.. code:: php

    Phamda::merge([1, 2], [3, 4, 5]); // => [1, 2, 3, 4, 5]
    Phamda::merge(['a', 'b'], ['a', 'b']); // => ['a', 'b', 'a', 'b']


min
---
``mixed Phamda::min(array|\Traversable $collection)``

Returns the smallest value in the collection.

.. code:: php

    Phamda::min([6, 15, 8, 9, -2, -3]); // => -3
    Phamda::min(['bar', 'foo', 'baz']); // => 'bar'


minBy
-----
``mixed Phamda::minBy(callable $getValue, array|\Traversable $collection)``

Returns the item from a collection for which the supplied function returns the smallest value.

.. code:: php

    $getFoo = function ($item) { return $item->foo; };
    $a = (object) ['baz' => 3, 'bar' => 16, 'foo' => 5];
    $b = (object) ['baz' => 1, 'bar' => 25, 'foo' => 8];
    $c = (object) ['baz' => 14, 'bar' => 20, 'foo' => -2];
    Phamda::minBy($getFoo, [$a, $b, $c]); // => $c


modulo
------
``int Phamda::modulo(int $x, int $y)``

Divides two integers and returns the modulo.

.. code:: php

    Phamda::modulo(15, 6); // => 3
    Phamda::modulo(22, 11); // => 0
    Phamda::modulo(-23, 6); // => -5


multiply
--------
``int|float Phamda::multiply(int|float $x, int|float $y)``

Multiplies two numbers.

.. code:: php

    Phamda::multiply(15, 27); // => 405
    Phamda::multiply(36, -8); // => -288


nAry
----
``callable Phamda::nAry(int $arity, callable $function)``

Wraps the given function in a function that accepts exactly the given amount of parameters.

.. code:: php

    $add3 = function ($a = 0, $b = 0, $c = 0) { return $a + $b + $c; };
    $add2 = Phamda::nAry(2, $add3);
    $add2(27, 15, 33); // => 42
    $add1 = Phamda::nAry(1, $add3);
    $add1(27, 15, 33); // => 27


negate
------
``int|float Phamda::negate(int|float $x)``

Returns the negation of a number.

.. code:: php

    Phamda::negate(15); // => -15
    Phamda::negate(-0.7); // => 0.7
    Phamda::negate(0); // => 0


none
----
``bool Phamda::none(callable $predicate, array|\Traversable $collection)``

Returns ``true`` if no element in the collection matches the predicate, ``false`` otherwise.

.. code:: php

    $isPositive = function ($x) { return $x > 0; };
    Phamda::none($isPositive, [1, 2, 0, -5]); // => false
    Phamda::none($isPositive, [-3, -7, -1, -5]); // => true


not
---
``callable Phamda::not(callable $predicate)``

Wraps a predicate and returns a function that return ``true`` if the wrapped function returns a falsey value, ``false`` otherwise.

.. code:: php

    $equal = function ($a, $b) { return $a === $b; };
    $notEqual = Phamda::not($equal);
    $notEqual(15, 13); // => true
    $notEqual(7, 7); // => false


partial
-------
``callable Phamda::partial(callable $function, mixed ... $initialArguments)``

Wraps the given function and returns a new function that can be called with the remaining parameters.

.. code:: php

    $add = function ($x, $y, $z) { return $x + $y + $z; };
    $addTen = Phamda::partial($add, 10);
    $addTen(3, 4); // => 17
    $addTwenty = Phamda::partial($add, 2, 3, 15);
    $addTwenty(); // => 20


partialN
--------
``callable Phamda::partialN(int $arity, callable $function, mixed ... $initialArguments)``

Wraps the given function and returns a new function of fixed arity that can be called with the remaining parameters.

.. code:: php

    $add = function ($x, $y, $z = 0) { return $x + $y + $z; };
    $addTen = Phamda::partialN(3, $add, 10);
    $addTwenty = $addTen(10);
    $addTwenty(5); // => 25


partition
---------
``array[]|Collection[] Phamda::partition(callable $predicate, array|\Traversable|Collection $collection)``

Returns the items of the original collection divided into two collections based on a predicate function.

.. code:: php

    $isPositive = function ($x) { return $x > 0; };
    Phamda::partition($isPositive, [4, -16, 7, -3, 2, 88]); // => [[0 => 4, 2 => 7, 4 => 2, 5 => 88], [1 => -16, 3 => -3]]


path
----
``mixed Phamda::path(array $path, array|object $object)``

Returns a value found at the given path.

.. code:: php

    Phamda::path(['foo', 'bar'], ['foo' => ['baz' => 26, 'bar' => 15]]); // => 15
    Phamda::path(['bar', 'baz'], ['bar' => ['baz' => null, 'foo' => 15]]); // => null


pathEq
------
``boolean Phamda::pathEq(array $path, mixed $value, array|object $object)``

Returns ``true`` if the given value is found at the specified path, ``false`` otherwise.

.. code:: php

    Phamda::pathEq(['foo', 'bar'], 44, ['foo' => ['baz' => 26, 'bar' => 15]]); // => false
    Phamda::pathEq(['foo', 'baz'], 26, ['foo' => ['baz' => 26, 'bar' => 15]]); // => true


pick
----
``array Phamda::pick(array $names, array $item)``

Returns a new array, containing only the values that have keys matching the given list.

.. code:: php

    Phamda::pick(['bar', 'fib'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => ['bar' => 'bzz']
    Phamda::pick(['fob', 'fib'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => []
    Phamda::pick(['bar', 'foo'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => ['bar' => 'bzz', 'foo' => null]


pickAll
-------
``array Phamda::pickAll(array $names, array $item)``

Returns a new array, containing the values that have keys matching the given list, including keys that are not found in the item.

.. code:: php

    Phamda::pickAll(['bar', 'fib'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => ['bar' => 'bzz', 'fib' => null]
    Phamda::pickAll(['fob', 'fib'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => ['fob' => null, 'fib' => null]
    Phamda::pickAll(['bar', 'foo'], ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob']); // => ['bar' => 'bzz', 'foo' => null]


pipe
----
``callable Phamda::pipe(callable ... $functions)``

Returns a new function that calls each supplied function in turn and passes the result as a parameter to the next function.

.. code:: php

    $add5 = function ($x) { return $x + 5; };
    $square = function ($x) { return $x ** 2; };
    $squareAdded = Phamda::pipe($add5, $square);
    $squareAdded(4); // => 81
    $hello = function ($target) { return 'Hello ' . $target; };
    $helloUpper = Phamda::pipe('strtoupper', $hello);
    $upperHello = Phamda::pipe($hello, 'strtoupper');
    $helloUpper('world'); // => 'Hello WORLD'
    $upperHello('world'); // => 'HELLO WORLD'


pluck
-----
``array|Collection Phamda::pluck(string $name, array|\Traversable|Collection $collection)``

Returns a new collection, where the items are single properties plucked from the given collection.

.. code:: php

    Phamda::pluck('foo', [['foo' => null, 'bar' => 'bzz', 'baz' => 'bob'], ['foo' => 'fii', 'baz' => 'pob']]); // => [null, 'fii']
    Phamda::pluck('baz', [['foo' => null, 'bar' => 'bzz', 'baz' => 'bob'], ['foo' => 'fii', 'baz' => 'pob']]); // => ['bob', 'pob']


prepend
-------
``array|Collection Phamda::prepend(mixed $item, array|Collection $collection)``

Return a new collection that contains the given item first and all the items in the given collection.

.. code:: php

    Phamda::prepend('c', ['a', 'b']); // => ['c', 'a', 'b']
    Phamda::prepend('c', []); // => ['c']
    Phamda::prepend(['d', 'e'], ['a', 'b']); // => [['d', 'e'], 'a', 'b']


product
-------
``int|float Phamda::product(int[]|float[] $values)``

Multiplies a list of numbers.

.. code:: php

    Phamda::product([11, -8, 3]); // => -264
    Phamda::product([1, 2, 3, 4, 5, 6]); // => 720


prop
----
``mixed Phamda::prop(string $name, array|object|\ArrayAccess $object)``

Returns the given element of an array or property of an object.

.. code:: php

    Phamda::prop('bar', ['bar' => 'fuz', 'baz' => null]); // => 'fuz'
    Phamda::prop('baz', ['bar' => 'fuz', 'baz' => null]); // => null


propEq
------
``bool Phamda::propEq(string $name, mixed $value, array|object $object)``

Returns ``true`` if the specified property has the given value, ``false`` otherwise.

.. code:: php

    Phamda::propEq('foo', 'bar', ['foo' => 'bar']); // => true
    Phamda::propEq('foo', 'baz', ['foo' => 'bar']); // => false


reduce
------
``mixed Phamda::reduce(callable $function, mixed $initial, array|\Traversable $collection)``

Returns a value accumulated by calling the given function for each element of the collection.

The supplied ``function`` receives one argument: ``item``.

.. code:: php

    $concat = function ($x, $y) { return $x . $y; };
    Phamda::reduce($concat, 'foo', ['bar', 'baz']); // => 'foobarbaz'


reduceIndexed
-------------
``mixed Phamda::reduceIndexed(callable $function, mixed $initial, array|\Traversable $collection)``

Returns a value accumulated by calling the given function for each element of the collection.

Like ``reduce``, but the supplied ``function`` receives three arguments: ``item``, ``index``, ``collection``.

.. code:: php

    $concat = function ($accumulator, $value, $key) { return $accumulator . $key . $value; };
    Phamda::reduceIndexed($concat, 'no', ['foo' => 'bar', 'fiz' => 'buz']); // => 'nofoobarfizbuz'


reduceRight
-----------
``mixed Phamda::reduceRight(callable $function, mixed $initial, array|\Traversable $collection)``

Returns a value accumulated by calling the given function for each element of the collection in reverse order.

The supplied ``function`` receives one argument: ``item``.

.. code:: php

    $concat = function ($x, $y) { return $x . $y; };
    Phamda::reduceRight($concat, 'foo', ['bar', 'baz']); // => 'foobazbar'


reduceRightIndexed
------------------
``mixed Phamda::reduceRightIndexed(callable $function, mixed $initial, array|\Traversable $collection)``

Returns a value accumulated by calling the given function for each element of the collection in reverse order.

Like ``reduceRight``, but the supplied ``function`` receives three arguments: ``item``, ``index``, ``collection``.

.. code:: php

    $concat = function ($accumulator, $value, $key) { return $accumulator . $key . $value; };
    Phamda::reduceRightIndexed($concat, 'no', ['foo' => 'bar', 'fiz' => 'buz']); // => 'nofizbuzfoobar'


reject
------
``array|Collection Phamda::reject(callable $predicate, array|\Traversable|Collection $collection)``

Returns a new collection containing the items that do not match the given predicate.

The supplied ``predicate`` receives one argument: ``item``.

.. code:: php

    $isEven = function ($x) { return $x % 2 === 0; };
    Phamda::reject($isEven, [1, 2, 3, 4]); // => [0 => 1, 2 => 3]


rejectIndexed
-------------
``array|Collection Phamda::rejectIndexed(callable $predicate, array|\Traversable|Collection $collection)``

Returns a new collection containing the items that do not match the given predicate.

Like ``reject``, but the supplied ``predicate`` receives three arguments: ``item``, ``index``, ``collection``.

.. code:: php

    $smallerThanNext = function ($value, $key, $list) { return isset($list[$key + 1]) ? $value < $list[$key + 1] : false; };
    Phamda::rejectIndexed($smallerThanNext, [3, 6, 2, 19]); // => [1 => 6, 3 => 19]


reverse
-------
``array|Collection Phamda::reverse(array|\Traversable|Collection $collection)``

Returns a new collection where the items are in a reverse order.

.. code:: php

    Phamda::reverse([3, 2, 1]); // => [2 => 1, 1 => 2, 0 => 3]
    Phamda::reverse([22, 4, 16, 5]); // => [3 => 5, 2 => 16, 1 => 4, 0 => 22]
    Phamda::reverse([]); // => []


slice
-----
``array|Collection Phamda::slice(int $start, int $end, array|\Traversable|Collection $collection)``

Returns a new collection, containing the items of the original from index ``start`` (inclusive) to index ``end`` (exclusive).

.. code:: php

    Phamda::slice(2, 6, [1, 2, 3, 4, 5, 6, 7, 8, 9]); // => [3, 4, 5, 6]
    Phamda::slice(0, 3, [1, 2, 3, 4, 5, 6, 7, 8, 9]); // => [1, 2, 3]
    Phamda::slice(7, 11, [1, 2, 3, 4, 5, 6, 7, 8, 9]); // => [8, 9]


sort
----
``array|Collection Phamda::sort(callable $comparator, array|\Traversable|Collection $collection)``

Returns a new collection sorted by the given comparator function.

.. code:: php

    $sub = function ($a, $b) { return $a - $b; };
    Phamda::sort($sub, [3, 2, 4, 1]); // => [1, 2, 3, 4]


sortBy
------
``array|Collection Phamda::sortBy(callable $function, array|\Traversable|Collection $collection)``

Returns a new collection sorted by comparing the values provided by calling the given function for each item.

.. code:: php

    $getFoo = function ($a) { return $a['foo']; };
    $collection = [['foo' => 16, 'bar' => 3], ['foo' => 5, 'bar' => 42], ['foo' => 11, 'bar' => 7]];
    Phamda::sortBy($getFoo, $collection); // => [['foo' => 5, 'bar' => 42], ['foo' => 11, 'bar' => 7], ['foo' => 16, 'bar' => 3]]


stringIndexOf
-------------
``int|false Phamda::stringIndexOf(string $substring, string $string)``

Returns the first index of a substring in a string, or ``false`` if the substring is not found.

.. code:: php

    Phamda::stringIndexOf('def', 'abcdefdef'); // => 3
    Phamda::stringIndexOf('a', 'abcdefgh'); // => 0
    Phamda::stringIndexOf('ghi', 'abcdefgh'); // => false


stringLastIndexOf
-----------------
``int|false Phamda::stringLastIndexOf(string $substring, string $string)``

Returns the last index of a substring in a string, or ``false`` if the substring is not found.

.. code:: php

    Phamda::stringLastIndexOf('def', 'abcdefdef'); // => 6
    Phamda::stringLastIndexOf('a', 'abcdefgh'); // => 0
    Phamda::stringLastIndexOf('ghi', 'abcdefgh'); // => false


substring
---------
``string Phamda::substring(int $start, int $end, string $string)``

Returns a substring of the original string between given indexes.

.. code:: php

    Phamda::substring(2, 5, 'foobarbaz'); // => 'oba'
    Phamda::substring(4, 8, 'foobarbaz'); // => 'arba'
    Phamda::substring(3, -2, 'foobarbaz'); // => 'barb'


substringFrom
-------------
``string Phamda::substringFrom(int $start, string $string)``

Returns a substring of the original string starting from the given index.

.. code:: php

    Phamda::substringFrom(5, 'foobarbaz'); // => 'rbaz'
    Phamda::substringFrom(1, 'foobarbaz'); // => 'oobarbaz'
    Phamda::substringFrom(-2, 'foobarbaz'); // => 'az'


substringTo
-----------
``string Phamda::substringTo(int $end, string $string)``

Returns a substring of the original string ending before the given index.

.. code:: php

    Phamda::substringTo(5, 'foobarbaz'); // => 'fooba'
    Phamda::substringTo(8, 'foobarbaz'); // => 'foobarba'
    Phamda::substringTo(-3, 'foobarbaz'); // => 'foobar'


subtract
--------
``int|float Phamda::subtract(int|float $x, int|float $y)``

Subtracts two numbers.

.. code:: php

    Phamda::subtract(15, 27); // => -12
    Phamda::subtract(36, -8); // => 44


sum
---
``int|float Phamda::sum(int[]|float[] $values)``

Adds together a list of numbers.

.. code:: php

    Phamda::sum([1, 2, 3, 4, 5, 6]); // => 21
    Phamda::sum([11, 0, 2, -4, 7]); // => 16


tail
----
``array|Collection Phamda::tail(array|\Traversable|Collection $collection)``

Returns a new collection that contains all the items from the original ``collection`` except the first.

.. code:: php

    Phamda::tail([2, 4, 6, 3]); // => [4, 6, 3]


tap
---
``mixed Phamda::tap(callable $function, mixed $object)``

Calls the provided function with the given value as a parameter and returns the value.

.. code:: php

    $addDay = function (\DateTime $date) { $date->add(new \DateInterval('P1D')); };
    $date = new \DateTime('2015-03-15');
    Phamda::tap($addDay, $date); // => $date
    $date->format('Y-m-d'); // => '2015-03-16'


times
-----
``array Phamda::times(callable $function, int $count)``

Calls the provided function the specified number of times and returns the results in an array.

.. code:: php

    $double = function ($number) { return $number * 2; };
    Phamda::times($double, 5); // => [0, 2, 4, 6, 8]


true
----
``callable Phamda::true()``

Returns a function that always returns ``true``.

.. code:: php

    $true = Phamda::true();
    $true(); // => true


unary
-----
``callable Phamda::unary(callable $function)``

Wraps the given function in a function that accepts exactly one parameter.

.. code:: php

    $add2 = function ($a = 0, $b = 0) { return $a + $b; };
    $add1 = Phamda::nAry(1, $add2);
    $add1(27, 15); // => 27


unapply
-------
``mixed Phamda::unapply(callable $function, mixed ... $arguments)``

Calls the ``function`` using the given ``arguments`` as a single array list argument.

Effectively creates an variadic function from a unary function.

.. code:: php

    $concat = function (array $strings) { return implode(' ', $strings); };
    Phamda::unapply($concat, 'foo', 'ba', 'rba'); // => 'foo ba rba'


where
-----
``mixed Phamda::where(array $specification, array|object $object)``

Returns true if the given object matches the specification.

.. code:: php

    Phamda::where(['a' => 15, 'b' => 16], ['a' => 15, 'b' => 42, 'c' => 88, 'd' => -10]); // => false
    Phamda::where(['a' => 15, 'b' => 16], ['a' => 15, 'b' => 16, 'c' => -20, 'd' => 77]); // => true


zip
---
``array Phamda::zip(array $a, array $b)``

Returns a new array of value pairs from the values of the given arrays with matching keys.

.. code:: php

    Phamda::zip([1, 2, 3], [4, 5, 6]); // => [[1, 4], [2, 5], [3, 6]]
    Phamda::zip(['a' => 1, 'b' => 2], ['a' => 3, 'c' => 4]); // => ['a' => [1, 3]]
    Phamda::zip([1, 2, 3], []); // => []


zipWith
-------
``array Phamda::zipWith(callable $function, array $a, array $b)``

Returns a new array of values created by calling the given function with the matching values of the given arrays.

.. code:: php

    $sum = function ($x, $y) { return $x + $y; };
    Phamda::zipWith($sum, [1, 2, 3], [5, 6]); // => [6, 8]
