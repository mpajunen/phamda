<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\Tests;

use Phamda\Phamda;

class BasicTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getAddData
     */
    public function testAdd($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::add($x, $y), 'add produces correct results.');
        $curried0 = Phamda::add();
        $this->assertSame($expected, $curried0($x, $y), 'add is curried correctly.');
        $curried1 = Phamda::add($x);
        $this->assertSame($expected, $curried1($y), 'add is curried correctly.');
    }

    /**
     * @dataProvider getAllData
     */
    public function testAll($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::all($predicate, $collection), 'all produces correct results.');
        $curried0 = Phamda::all();
        $this->assertSame($expected, $curried0($predicate, $collection), 'all is curried correctly.');
        $curried1 = Phamda::all($predicate);
        $this->assertSame($expected, $curried1($collection), 'all is curried correctly.');
    }

    /**
     * @dataProvider getAllPassData
     */
    public function testAllPass($expected, array $predicates, ... $arguments)
    {
        $main0 = Phamda::allPass($predicates);
        $this->assertSame($expected, $main0(...$arguments), 'allPass produces correct results.');
        $curried0 = Phamda::allPass();
        $main1    = $curried0($predicates);
        $this->assertSame($expected, $main1(...$arguments), 'allPass is curried correctly.');
    }

    /**
     * @dataProvider getAlwaysData
     */
    public function testAlways($expected, $value)
    {
        $main0 = Phamda::always($value);
        $this->assertSame($expected, $main0(), 'always produces correct results.');
        $curried0 = Phamda::always();
        $main1    = $curried0($value);
        $this->assertSame($expected, $main1(), 'always is curried correctly.');
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAny($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::any($predicate, $collection), 'any produces correct results.');
        $curried0 = Phamda::any();
        $this->assertSame($expected, $curried0($predicate, $collection), 'any is curried correctly.');
        $curried1 = Phamda::any($predicate);
        $this->assertSame($expected, $curried1($collection), 'any is curried correctly.');
    }

    /**
     * @dataProvider getAnyPassData
     */
    public function testAnyPass($expected, array $predicates, ... $arguments)
    {
        $main0 = Phamda::anyPass($predicates);
        $this->assertSame($expected, $main0(...$arguments), 'anyPass produces correct results.');
        $curried0 = Phamda::anyPass();
        $main1    = $curried0($predicates);
        $this->assertSame($expected, $main1(...$arguments), 'anyPass is curried correctly.');
    }

    /**
     * @dataProvider getAssocData
     */
    public function testAssoc($expected, $property, $value, $object)
    {
        $this->assertSame($expected, Phamda::assoc($property, $value, $object), 'assoc produces correct results.');
        $curried0 = Phamda::assoc();
        $this->assertSame($expected, $curried0($property, $value, $object), 'assoc is curried correctly.');
        $curried1 = Phamda::assoc($property);
        $this->assertSame($expected, $curried1($value, $object), 'assoc is curried correctly.');
        $curried2 = Phamda::assoc($property, $value);
        $this->assertSame($expected, $curried2($object), 'assoc is curried correctly.');
    }

    /**
     * @dataProvider getAssocPathData
     */
    public function testAssocPath($expected, array $path, $value, $object)
    {
        $this->assertSame($expected, Phamda::assocPath($path, $value, $object), 'assocPath produces correct results.');
        $curried0 = Phamda::assocPath();
        $this->assertSame($expected, $curried0($path, $value, $object), 'assocPath is curried correctly.');
        $curried1 = Phamda::assocPath($path);
        $this->assertSame($expected, $curried1($value, $object), 'assocPath is curried correctly.');
        $curried2 = Phamda::assocPath($path, $value);
        $this->assertSame($expected, $curried2($object), 'assocPath is curried correctly.');
    }

    /**
     * @dataProvider getBothData
     */
    public function testBoth($expected, callable $a, callable $b, ... $arguments)
    {
        $main0 = Phamda::both($a, $b);
        $this->assertSame($expected, $main0(...$arguments), 'both produces correct results.');
        $curried0 = Phamda::both();
        $main1    = $curried0($a, $b);
        $this->assertSame($expected, $main1(...$arguments), 'both is curried correctly.');
        $curried1 = Phamda::both($a);
        $main2    = $curried1($b);
        $this->assertSame($expected, $main2(...$arguments), 'both is curried correctly.');
    }

    /**
     * @dataProvider getComparatorData
     */
    public function testComparator($expected, callable $predicate, $x, $y)
    {
        $main0 = Phamda::comparator($predicate);
        $this->assertSame($expected, $main0($x, $y), 'comparator produces correct results.');
        $curried0 = Phamda::comparator();
        $main1    = $curried0($predicate);
        $this->assertSame($expected, $main1($x, $y), 'comparator is curried correctly.');
    }

    /**
     * @dataProvider getComposeData
     */
    public function testCompose($expected, array $functions, ... $arguments)
    {
        $main0 = Phamda::compose(...$functions);
        $this->assertSame($expected, $main0(...$arguments), 'compose produces correct results.');
    }

    /**
     * @dataProvider getContainsData
     */
    public function testContains($expected, $value, $collection)
    {
        $this->assertSame($expected, Phamda::contains($value, $collection), 'contains produces correct results.');
        $curried0 = Phamda::contains();
        $this->assertSame($expected, $curried0($value, $collection), 'contains is curried correctly.');
        $curried1 = Phamda::contains($value);
        $this->assertSame($expected, $curried1($collection), 'contains is curried correctly.');
    }

    /**
     * @dataProvider getCurryData
     */
    public function testCurry($expected, callable $function, ... $initialArguments)
    {
        $this->assertSame($expected, Phamda::curry($function, ...$initialArguments), 'curry produces correct results.');
        $curried0 = Phamda::curry();
        $this->assertSame($expected, $curried0($function, ...$initialArguments), 'curry is curried correctly.');
        $curried1 = Phamda::curry($function);
        $this->assertSame($expected, $curried1(...$initialArguments), 'curry is curried correctly.');
    }

    /**
     * @dataProvider getCurryNData
     */
    public function testCurryN($expected, $length, callable $function, ... $initialArguments)
    {
        $this->assertSame($expected, Phamda::curryN($length, $function, ...$initialArguments), 'curryN produces correct results.');
        $curried0 = Phamda::curryN();
        $this->assertSame($expected, $curried0($length, $function, ...$initialArguments), 'curryN is curried correctly.');
        $curried1 = Phamda::curryN($length);
        $this->assertSame($expected, $curried1($function, ...$initialArguments), 'curryN is curried correctly.');
        $curried2 = Phamda::curryN($length, $function);
        $this->assertSame($expected, $curried2(...$initialArguments), 'curryN is curried correctly.');
    }

    /**
     * @dataProvider getDecData
     */
    public function testDec($expected, $number)
    {
        $this->assertSame($expected, Phamda::dec($number), 'dec produces correct results.');
        $curried0 = Phamda::dec();
        $this->assertSame($expected, $curried0($number), 'dec is curried correctly.');
    }

    /**
     * @dataProvider getDefaultToData
     */
    public function testDefaultTo($expected, $default, $value)
    {
        $this->assertSame($expected, Phamda::defaultTo($default, $value), 'defaultTo produces correct results.');
        $curried0 = Phamda::defaultTo();
        $this->assertSame($expected, $curried0($default, $value), 'defaultTo is curried correctly.');
        $curried1 = Phamda::defaultTo($default);
        $this->assertSame($expected, $curried1($value), 'defaultTo is curried correctly.');
    }

    /**
     * @dataProvider getDivideData
     */
    public function testDivide($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::divide($x, $y), 'divide produces correct results.');
        $curried0 = Phamda::divide();
        $this->assertSame($expected, $curried0($x, $y), 'divide is curried correctly.');
        $curried1 = Phamda::divide($x);
        $this->assertSame($expected, $curried1($y), 'divide is curried correctly.');
    }

    /**
     * @dataProvider getEitherData
     */
    public function testEither($expected, callable $a, callable $b, ... $arguments)
    {
        $main0 = Phamda::either($a, $b);
        $this->assertSame($expected, $main0(...$arguments), 'either produces correct results.');
        $curried0 = Phamda::either();
        $main1    = $curried0($a, $b);
        $this->assertSame($expected, $main1(...$arguments), 'either is curried correctly.');
        $curried1 = Phamda::either($a);
        $main2    = $curried1($b);
        $this->assertSame($expected, $main2(...$arguments), 'either is curried correctly.');
    }

    /**
     * @dataProvider getEqData
     */
    public function testEq($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::eq($x, $y), 'eq produces correct results.');
        $curried0 = Phamda::eq();
        $this->assertSame($expected, $curried0($x, $y), 'eq is curried correctly.');
        $curried1 = Phamda::eq($x);
        $this->assertSame($expected, $curried1($y), 'eq is curried correctly.');
    }

    /**
     * @dataProvider getFalseData
     */
    public function testFalse($expected)
    {
        $main0 = Phamda::false();
        $this->assertSame($expected, $main0(), 'false produces correct results.');
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilter($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::filter($predicate, $collection), 'filter produces correct results.');
        $curried0 = Phamda::filter();
        $this->assertSame($expected, $curried0($predicate, $collection), 'filter is curried correctly.');
        $curried1 = Phamda::filter($predicate);
        $this->assertSame($expected, $curried1($collection), 'filter is curried correctly.');
    }

    /**
     * @dataProvider getFindData
     */
    public function testFind($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::find($predicate, $collection), 'find produces correct results.');
        $curried0 = Phamda::find();
        $this->assertSame($expected, $curried0($predicate, $collection), 'find is curried correctly.');
        $curried1 = Phamda::find($predicate);
        $this->assertSame($expected, $curried1($collection), 'find is curried correctly.');
    }

    /**
     * @dataProvider getFindIndexData
     */
    public function testFindIndex($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::findIndex($predicate, $collection), 'findIndex produces correct results.');
        $curried0 = Phamda::findIndex();
        $this->assertSame($expected, $curried0($predicate, $collection), 'findIndex is curried correctly.');
        $curried1 = Phamda::findIndex($predicate);
        $this->assertSame($expected, $curried1($collection), 'findIndex is curried correctly.');
    }

    /**
     * @dataProvider getFindLastData
     */
    public function testFindLast($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::findLast($predicate, $collection), 'findLast produces correct results.');
        $curried0 = Phamda::findLast();
        $this->assertSame($expected, $curried0($predicate, $collection), 'findLast is curried correctly.');
        $curried1 = Phamda::findLast($predicate);
        $this->assertSame($expected, $curried1($collection), 'findLast is curried correctly.');
    }

    /**
     * @dataProvider getFindLastIndexData
     */
    public function testFindLastIndex($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::findLastIndex($predicate, $collection), 'findLastIndex produces correct results.');
        $curried0 = Phamda::findLastIndex();
        $this->assertSame($expected, $curried0($predicate, $collection), 'findLastIndex is curried correctly.');
        $curried1 = Phamda::findLastIndex($predicate);
        $this->assertSame($expected, $curried1($collection), 'findLastIndex is curried correctly.');
    }

    /**
     * @dataProvider getFirstData
     */
    public function testFirst($expected, $collection)
    {
        $this->assertSame($expected, Phamda::first($collection), 'first produces correct results.');
        $curried0 = Phamda::first();
        $this->assertSame($expected, $curried0($collection), 'first is curried correctly.');
    }

    /**
     * @dataProvider getFlipData
     */
    public function testFlip($expected, callable $function, $a, $b, ... $arguments)
    {
        $main0 = Phamda::flip($function);
        $this->assertSame($expected, $main0($a, $b, ...$arguments), 'flip produces correct results.');
        $curried0 = Phamda::flip();
        $main1    = $curried0($function);
        $this->assertSame($expected, $main1($a, $b, ...$arguments), 'flip is curried correctly.');
    }

    /**
     * @dataProvider getGroupByData
     */
    public function testGroupBy($expected, callable $function, $collection)
    {
        $this->assertSame($expected, Phamda::groupBy($function, $collection), 'groupBy produces correct results.');
        $curried0 = Phamda::groupBy();
        $this->assertSame($expected, $curried0($function, $collection), 'groupBy is curried correctly.');
        $curried1 = Phamda::groupBy($function);
        $this->assertSame($expected, $curried1($collection), 'groupBy is curried correctly.');
    }

    /**
     * @dataProvider getGtData
     */
    public function testGt($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::gt($x, $y), 'gt produces correct results.');
        $curried0 = Phamda::gt();
        $this->assertSame($expected, $curried0($x, $y), 'gt is curried correctly.');
        $curried1 = Phamda::gt($x);
        $this->assertSame($expected, $curried1($y), 'gt is curried correctly.');
    }

    /**
     * @dataProvider getGteData
     */
    public function testGte($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::gte($x, $y), 'gte produces correct results.');
        $curried0 = Phamda::gte();
        $this->assertSame($expected, $curried0($x, $y), 'gte is curried correctly.');
        $curried1 = Phamda::gte($x);
        $this->assertSame($expected, $curried1($y), 'gte is curried correctly.');
    }

    /**
     * @dataProvider getIdentityData
     */
    public function testIdentity($expected, $x)
    {
        $this->assertSame($expected, Phamda::identity($x), 'identity produces correct results.');
        $curried0 = Phamda::identity();
        $this->assertSame($expected, $curried0($x), 'identity is curried correctly.');
    }

    /**
     * @dataProvider getIfElseData
     */
    public function testIfElse($expected, callable $condition, callable $onTrue, callable $onFalse, ... $arguments)
    {
        $main0 = Phamda::ifElse($condition, $onTrue, $onFalse);
        $this->assertSame($expected, $main0(...$arguments), 'ifElse produces correct results.');
        $curried0 = Phamda::ifElse();
        $main1    = $curried0($condition, $onTrue, $onFalse);
        $this->assertSame($expected, $main1(...$arguments), 'ifElse is curried correctly.');
        $curried1 = Phamda::ifElse($condition);
        $main2    = $curried1($onTrue, $onFalse);
        $this->assertSame($expected, $main2(...$arguments), 'ifElse is curried correctly.');
        $curried2 = Phamda::ifElse($condition, $onTrue);
        $main3    = $curried2($onFalse);
        $this->assertSame($expected, $main3(...$arguments), 'ifElse is curried correctly.');
    }

    /**
     * @dataProvider getIncData
     */
    public function testInc($expected, $number)
    {
        $this->assertSame($expected, Phamda::inc($number), 'inc produces correct results.');
        $curried0 = Phamda::inc();
        $this->assertSame($expected, $curried0($number), 'inc is curried correctly.');
    }

    /**
     * @dataProvider getIndexOfData
     */
    public function testIndexOf($expected, $item, $collection)
    {
        $this->assertSame($expected, Phamda::indexOf($item, $collection), 'indexOf produces correct results.');
        $curried0 = Phamda::indexOf();
        $this->assertSame($expected, $curried0($item, $collection), 'indexOf is curried correctly.');
        $curried1 = Phamda::indexOf($item);
        $this->assertSame($expected, $curried1($collection), 'indexOf is curried correctly.');
    }

    /**
     * @dataProvider getIsEmptyData
     */
    public function testIsEmpty($expected, $collection)
    {
        $this->assertSame($expected, Phamda::isEmpty($collection), 'isEmpty produces correct results.');
        $curried0 = Phamda::isEmpty();
        $this->assertSame($expected, $curried0($collection), 'isEmpty is curried correctly.');
    }

    /**
     * @dataProvider getIsInstanceData
     */
    public function testIsInstance($expected, $class, $object)
    {
        $this->assertSame($expected, Phamda::isInstance($class, $object), 'isInstance produces correct results.');
        $curried0 = Phamda::isInstance();
        $this->assertSame($expected, $curried0($class, $object), 'isInstance is curried correctly.');
        $curried1 = Phamda::isInstance($class);
        $this->assertSame($expected, $curried1($object), 'isInstance is curried correctly.');
    }

    /**
     * @dataProvider getLastData
     */
    public function testLast($expected, $collection)
    {
        $this->assertSame($expected, Phamda::last($collection), 'last produces correct results.');
        $curried0 = Phamda::last();
        $this->assertSame($expected, $curried0($collection), 'last is curried correctly.');
    }

    /**
     * @dataProvider getLtData
     */
    public function testLt($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::lt($x, $y), 'lt produces correct results.');
        $curried0 = Phamda::lt();
        $this->assertSame($expected, $curried0($x, $y), 'lt is curried correctly.');
        $curried1 = Phamda::lt($x);
        $this->assertSame($expected, $curried1($y), 'lt is curried correctly.');
    }

    /**
     * @dataProvider getLteData
     */
    public function testLte($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::lte($x, $y), 'lte produces correct results.');
        $curried0 = Phamda::lte();
        $this->assertSame($expected, $curried0($x, $y), 'lte is curried correctly.');
        $curried1 = Phamda::lte($x);
        $this->assertSame($expected, $curried1($y), 'lte is curried correctly.');
    }

    /**
     * @dataProvider getMapData
     */
    public function testMap($expected, callable $function, $collection)
    {
        $this->assertSame($expected, Phamda::map($function, $collection), 'map produces correct results.');
        $curried0 = Phamda::map();
        $this->assertSame($expected, $curried0($function, $collection), 'map is curried correctly.');
        $curried1 = Phamda::map($function);
        $this->assertSame($expected, $curried1($collection), 'map is curried correctly.');
    }

    /**
     * @dataProvider getMaxData
     */
    public function testMax($expected, $collection)
    {
        $this->assertSame($expected, Phamda::max($collection), 'max produces correct results.');
        $curried0 = Phamda::max();
        $this->assertSame($expected, $curried0($collection), 'max is curried correctly.');
    }

    /**
     * @dataProvider getMaxByData
     */
    public function testMaxBy($expected, callable $getValue, $collection)
    {
        $this->assertSame($expected, Phamda::maxBy($getValue, $collection), 'maxBy produces correct results.');
        $curried0 = Phamda::maxBy();
        $this->assertSame($expected, $curried0($getValue, $collection), 'maxBy is curried correctly.');
        $curried1 = Phamda::maxBy($getValue);
        $this->assertSame($expected, $curried1($collection), 'maxBy is curried correctly.');
    }

    /**
     * @dataProvider getMinData
     */
    public function testMin($expected, $collection)
    {
        $this->assertSame($expected, Phamda::min($collection), 'min produces correct results.');
        $curried0 = Phamda::min();
        $this->assertSame($expected, $curried0($collection), 'min is curried correctly.');
    }

    /**
     * @dataProvider getMinByData
     */
    public function testMinBy($expected, callable $getValue, $collection)
    {
        $this->assertSame($expected, Phamda::minBy($getValue, $collection), 'minBy produces correct results.');
        $curried0 = Phamda::minBy();
        $this->assertSame($expected, $curried0($getValue, $collection), 'minBy is curried correctly.');
        $curried1 = Phamda::minBy($getValue);
        $this->assertSame($expected, $curried1($collection), 'minBy is curried correctly.');
    }

    /**
     * @dataProvider getModuloData
     */
    public function testModulo($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::modulo($x, $y), 'modulo produces correct results.');
        $curried0 = Phamda::modulo();
        $this->assertSame($expected, $curried0($x, $y), 'modulo is curried correctly.');
        $curried1 = Phamda::modulo($x);
        $this->assertSame($expected, $curried1($y), 'modulo is curried correctly.');
    }

    /**
     * @dataProvider getMultiplyData
     */
    public function testMultiply($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::multiply($x, $y), 'multiply produces correct results.');
        $curried0 = Phamda::multiply();
        $this->assertSame($expected, $curried0($x, $y), 'multiply is curried correctly.');
        $curried1 = Phamda::multiply($x);
        $this->assertSame($expected, $curried1($y), 'multiply is curried correctly.');
    }

    /**
     * @dataProvider getNegateData
     */
    public function testNegate($expected, $x)
    {
        $this->assertSame($expected, Phamda::negate($x), 'negate produces correct results.');
        $curried0 = Phamda::negate();
        $this->assertSame($expected, $curried0($x), 'negate is curried correctly.');
    }

    /**
     * @dataProvider getNoneData
     */
    public function testNone($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::none($predicate, $collection), 'none produces correct results.');
        $curried0 = Phamda::none();
        $this->assertSame($expected, $curried0($predicate, $collection), 'none is curried correctly.');
        $curried1 = Phamda::none($predicate);
        $this->assertSame($expected, $curried1($collection), 'none is curried correctly.');
    }

    /**
     * @dataProvider getNotData
     */
    public function testNot($expected, callable $predicate, ... $arguments)
    {
        $main0 = Phamda::not($predicate);
        $this->assertSame($expected, $main0(...$arguments), 'not produces correct results.');
        $curried0 = Phamda::not();
        $main1    = $curried0($predicate);
        $this->assertSame($expected, $main1(...$arguments), 'not is curried correctly.');
    }

    /**
     * @dataProvider getPartitionData
     */
    public function testPartition($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::partition($predicate, $collection), 'partition produces correct results.');
        $curried0 = Phamda::partition();
        $this->assertSame($expected, $curried0($predicate, $collection), 'partition is curried correctly.');
        $curried1 = Phamda::partition($predicate);
        $this->assertSame($expected, $curried1($collection), 'partition is curried correctly.');
    }

    /**
     * @dataProvider getPathData
     */
    public function testPath($expected, array $path, $object)
    {
        $this->assertSame($expected, Phamda::path($path, $object), 'path produces correct results.');
        $curried0 = Phamda::path();
        $this->assertSame($expected, $curried0($path, $object), 'path is curried correctly.');
        $curried1 = Phamda::path($path);
        $this->assertSame($expected, $curried1($object), 'path is curried correctly.');
    }

    /**
     * @dataProvider getPathEqData
     */
    public function testPathEq($expected, array $path, $value, $object)
    {
        $this->assertSame($expected, Phamda::pathEq($path, $value, $object), 'pathEq produces correct results.');
        $curried0 = Phamda::pathEq();
        $this->assertSame($expected, $curried0($path, $value, $object), 'pathEq is curried correctly.');
        $curried1 = Phamda::pathEq($path);
        $this->assertSame($expected, $curried1($value, $object), 'pathEq is curried correctly.');
        $curried2 = Phamda::pathEq($path, $value);
        $this->assertSame($expected, $curried2($object), 'pathEq is curried correctly.');
    }

    /**
     * @dataProvider getPickData
     */
    public function testPick($expected, array $names, array $item)
    {
        $this->assertSame($expected, Phamda::pick($names, $item), 'pick produces correct results.');
        $curried0 = Phamda::pick();
        $this->assertSame($expected, $curried0($names, $item), 'pick is curried correctly.');
        $curried1 = Phamda::pick($names);
        $this->assertSame($expected, $curried1($item), 'pick is curried correctly.');
    }

    /**
     * @dataProvider getPickAllData
     */
    public function testPickAll($expected, array $names, array $item)
    {
        $this->assertSame($expected, Phamda::pickAll($names, $item), 'pickAll produces correct results.');
        $curried0 = Phamda::pickAll();
        $this->assertSame($expected, $curried0($names, $item), 'pickAll is curried correctly.');
        $curried1 = Phamda::pickAll($names);
        $this->assertSame($expected, $curried1($item), 'pickAll is curried correctly.');
    }

    /**
     * @dataProvider getPipeData
     */
    public function testPipe($expected, array $functions, ... $arguments)
    {
        $main0 = Phamda::pipe(...$functions);
        $this->assertSame($expected, $main0(...$arguments), 'pipe produces correct results.');
    }

    /**
     * @dataProvider getPluckData
     */
    public function testPluck($expected, $name, $collection)
    {
        $this->assertSame($expected, Phamda::pluck($name, $collection), 'pluck produces correct results.');
        $curried0 = Phamda::pluck();
        $this->assertSame($expected, $curried0($name, $collection), 'pluck is curried correctly.');
        $curried1 = Phamda::pluck($name);
        $this->assertSame($expected, $curried1($collection), 'pluck is curried correctly.');
    }

    /**
     * @dataProvider getProductData
     */
    public function testProduct($expected, $values)
    {
        $this->assertSame($expected, Phamda::product($values), 'product produces correct results.');
        $curried0 = Phamda::product();
        $this->assertSame($expected, $curried0($values), 'product is curried correctly.');
    }

    /**
     * @dataProvider getPropData
     */
    public function testProp($expected, $name, $object)
    {
        $this->assertSame($expected, Phamda::prop($name, $object), 'prop produces correct results.');
        $curried0 = Phamda::prop();
        $this->assertSame($expected, $curried0($name, $object), 'prop is curried correctly.');
        $curried1 = Phamda::prop($name);
        $this->assertSame($expected, $curried1($object), 'prop is curried correctly.');
    }

    /**
     * @dataProvider getPropEqData
     */
    public function testPropEq($expected, $name, $value, $object)
    {
        $this->assertSame($expected, Phamda::propEq($name, $value, $object), 'propEq produces correct results.');
        $curried0 = Phamda::propEq();
        $this->assertSame($expected, $curried0($name, $value, $object), 'propEq is curried correctly.');
        $curried1 = Phamda::propEq($name);
        $this->assertSame($expected, $curried1($value, $object), 'propEq is curried correctly.');
        $curried2 = Phamda::propEq($name, $value);
        $this->assertSame($expected, $curried2($object), 'propEq is curried correctly.');
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduce($expected, callable $function, $initial, $collection)
    {
        $this->assertSame($expected, Phamda::reduce($function, $initial, $collection), 'reduce produces correct results.');
        $curried0 = Phamda::reduce();
        $this->assertSame($expected, $curried0($function, $initial, $collection), 'reduce is curried correctly.');
        $curried1 = Phamda::reduce($function);
        $this->assertSame($expected, $curried1($initial, $collection), 'reduce is curried correctly.');
        $curried2 = Phamda::reduce($function, $initial);
        $this->assertSame($expected, $curried2($collection), 'reduce is curried correctly.');
    }

    /**
     * @dataProvider getReduceRightData
     */
    public function testReduceRight($expected, callable $function, $initial, $collection)
    {
        $this->assertSame($expected, Phamda::reduceRight($function, $initial, $collection), 'reduceRight produces correct results.');
        $curried0 = Phamda::reduceRight();
        $this->assertSame($expected, $curried0($function, $initial, $collection), 'reduceRight is curried correctly.');
        $curried1 = Phamda::reduceRight($function);
        $this->assertSame($expected, $curried1($initial, $collection), 'reduceRight is curried correctly.');
        $curried2 = Phamda::reduceRight($function, $initial);
        $this->assertSame($expected, $curried2($collection), 'reduceRight is curried correctly.');
    }

    /**
     * @dataProvider getRejectData
     */
    public function testReject($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::reject($predicate, $collection), 'reject produces correct results.');
        $curried0 = Phamda::reject();
        $this->assertSame($expected, $curried0($predicate, $collection), 'reject is curried correctly.');
        $curried1 = Phamda::reject($predicate);
        $this->assertSame($expected, $curried1($collection), 'reject is curried correctly.');
    }

    /**
     * @dataProvider getReverseData
     */
    public function testReverse($expected, $collection)
    {
        $this->assertSame($expected, Phamda::reverse($collection), 'reverse produces correct results.');
        $curried0 = Phamda::reverse();
        $this->assertSame($expected, $curried0($collection), 'reverse is curried correctly.');
    }

    /**
     * @dataProvider getSliceData
     */
    public function testSlice($expected, $start, $end, $collection)
    {
        $this->assertSame($expected, Phamda::slice($start, $end, $collection), 'slice produces correct results.');
        $curried0 = Phamda::slice();
        $this->assertSame($expected, $curried0($start, $end, $collection), 'slice is curried correctly.');
        $curried1 = Phamda::slice($start);
        $this->assertSame($expected, $curried1($end, $collection), 'slice is curried correctly.');
        $curried2 = Phamda::slice($start, $end);
        $this->assertSame($expected, $curried2($collection), 'slice is curried correctly.');
    }

    /**
     * @dataProvider getSortData
     */
    public function testSort($expected, callable $comparator, $collection)
    {
        $this->assertSame($expected, Phamda::sort($comparator, $collection), 'sort produces correct results.');
        $curried0 = Phamda::sort();
        $this->assertSame($expected, $curried0($comparator, $collection), 'sort is curried correctly.');
        $curried1 = Phamda::sort($comparator);
        $this->assertSame($expected, $curried1($collection), 'sort is curried correctly.');
    }

    /**
     * @dataProvider getSortByData
     */
    public function testSortBy($expected, callable $function, $collection)
    {
        $this->assertSame($expected, Phamda::sortBy($function, $collection), 'sortBy produces correct results.');
        $curried0 = Phamda::sortBy();
        $this->assertSame($expected, $curried0($function, $collection), 'sortBy is curried correctly.');
        $curried1 = Phamda::sortBy($function);
        $this->assertSame($expected, $curried1($collection), 'sortBy is curried correctly.');
    }

    /**
     * @dataProvider getSubtractData
     */
    public function testSubtract($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::subtract($x, $y), 'subtract produces correct results.');
        $curried0 = Phamda::subtract();
        $this->assertSame($expected, $curried0($x, $y), 'subtract is curried correctly.');
        $curried1 = Phamda::subtract($x);
        $this->assertSame($expected, $curried1($y), 'subtract is curried correctly.');
    }

    /**
     * @dataProvider getSumData
     */
    public function testSum($expected, $values)
    {
        $this->assertSame($expected, Phamda::sum($values), 'sum produces correct results.');
        $curried0 = Phamda::sum();
        $this->assertSame($expected, $curried0($values), 'sum is curried correctly.');
    }

    /**
     * @dataProvider getTapData
     */
    public function testTap($expected, callable $function, $object)
    {
        $this->assertSame($expected, Phamda::tap($function, $object), 'tap produces correct results.');
        $curried0 = Phamda::tap();
        $this->assertSame($expected, $curried0($function, $object), 'tap is curried correctly.');
        $curried1 = Phamda::tap($function);
        $this->assertSame($expected, $curried1($object), 'tap is curried correctly.');
    }

    /**
     * @dataProvider getTimesData
     */
    public function testTimes($expected, callable $function, $count)
    {
        $this->assertSame($expected, Phamda::times($function, $count), 'times produces correct results.');
        $curried0 = Phamda::times();
        $this->assertSame($expected, $curried0($function, $count), 'times is curried correctly.');
        $curried1 = Phamda::times($function);
        $this->assertSame($expected, $curried1($count), 'times is curried correctly.');
    }

    /**
     * @dataProvider getTrueData
     */
    public function testTrue($expected)
    {
        $main0 = Phamda::true();
        $this->assertSame($expected, $main0(), 'true produces correct results.');
    }

    /**
     * @dataProvider getWhereData
     */
    public function testWhere($expected, array $specification, $object)
    {
        $this->assertSame($expected, Phamda::where($specification, $object), 'where produces correct results.');
        $curried0 = Phamda::where();
        $this->assertSame($expected, $curried0($specification, $object), 'where is curried correctly.');
        $curried1 = Phamda::where($specification);
        $this->assertSame($expected, $curried1($object), 'where is curried correctly.');
    }

    /**
     * @dataProvider getZipData
     */
    public function testZip($expected, array $a, array $b)
    {
        $this->assertSame($expected, Phamda::zip($a, $b), 'zip produces correct results.');
        $curried0 = Phamda::zip();
        $this->assertSame($expected, $curried0($a, $b), 'zip is curried correctly.');
        $curried1 = Phamda::zip($a);
        $this->assertSame($expected, $curried1($b), 'zip is curried correctly.');
    }

    /**
     * @dataProvider getZipWithData
     */
    public function testZipWith($expected, callable $function, array $a, array $b)
    {
        $this->assertSame($expected, Phamda::zipWith($function, $a, $b), 'zipWith produces correct results.');
        $curried0 = Phamda::zipWith();
        $this->assertSame($expected, $curried0($function, $a, $b), 'zipWith is curried correctly.');
        $curried1 = Phamda::zipWith($function);
        $this->assertSame($expected, $curried1($a, $b), 'zipWith is curried correctly.');
        $curried2 = Phamda::zipWith($function, $a);
        $this->assertSame($expected, $curried2($b), 'zipWith is curried correctly.');
    }
}
