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
        $this->assertSame($expected, Phamda::add($x, $y));
        $curried0 = Phamda::add();
        $this->assertSame($expected, $curried0($x, $y));
        $curried1 = Phamda::add($x);
        $this->assertSame($expected, $curried1($y));
    }

    /**
     * @dataProvider getAllData
     */
    public function testAll($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::all($predicate, $collection));
        $curried0 = Phamda::all();
        $this->assertSame($expected, $curried0($predicate, $collection));
        $curried1 = Phamda::all($predicate);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getAllPassData
     */
    public function testAllPass($expected, array $predicates, ... $arguments)
    {
        $main0 = Phamda::allPass($predicates);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::allPass();
        $main1    = $curried0($predicates);
        $this->assertSame($expected, $main1(...$arguments));
    }

    /**
     * @dataProvider getAlwaysData
     */
    public function testAlways($expected, $value)
    {
        $wrapped = Phamda::always($value);
        $this->assertSame($expected, $wrapped());
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAny($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::any($predicate, $collection));
        $curried0 = Phamda::any();
        $this->assertSame($expected, $curried0($predicate, $collection));
        $curried1 = Phamda::any($predicate);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getAnyPassData
     */
    public function testAnyPass($expected, array $predicates, ... $arguments)
    {
        $main0 = Phamda::anyPass($predicates);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::anyPass();
        $main1    = $curried0($predicates);
        $this->assertSame($expected, $main1(...$arguments));
    }

    /**
     * @dataProvider getAssocData
     */
    public function testAssoc($expected, $property, $value, $object)
    {
        $this->assertSame($expected, Phamda::assoc($property, $value, $object));
        $curried0 = Phamda::assoc();
        $this->assertSame($expected, $curried0($property, $value, $object));
        $curried1 = Phamda::assoc($property);
        $this->assertSame($expected, $curried1($value, $object));
        $curried2 = Phamda::assoc($property, $value);
        $this->assertSame($expected, $curried2($object));
    }

    /**
     * @dataProvider getAssocPathData
     */
    public function testAssocPath($expected, array $path, $value, $object)
    {
        $this->assertSame($expected, Phamda::assocPath($path, $value, $object));
        $curried0 = Phamda::assocPath();
        $this->assertSame($expected, $curried0($path, $value, $object));
        $curried1 = Phamda::assocPath($path);
        $this->assertSame($expected, $curried1($value, $object));
        $curried2 = Phamda::assocPath($path, $value);
        $this->assertSame($expected, $curried2($object));
    }

    /**
     * @dataProvider getBothData
     */
    public function testBoth($expected, callable $a, callable $b, ... $arguments)
    {
        $main0 = Phamda::both($a, $b);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::both();
        $main1    = $curried0($a, $b);
        $this->assertSame($expected, $main1(...$arguments));
        $curried1 = Phamda::both($a);
        $main2    = $curried1($b);
        $this->assertSame($expected, $main2(...$arguments));
    }

    /**
     * @dataProvider getComparatorData
     */
    public function testComparator($expected, callable $predicate, $x, $y)
    {
        $main0 = Phamda::comparator($predicate);
        $this->assertSame($expected, $main0($x, $y));
        $curried0 = Phamda::comparator();
        $main1    = $curried0($predicate);
        $this->assertSame($expected, $main1($x, $y));
    }

    /**
     * @dataProvider getComposeData
     */
    public function testCompose($expected, array $functions, ... $arguments)
    {
        $main0 = Phamda::compose(...$functions);
        $this->assertSame($expected, $main0(...$arguments));
    }

    /**
     * @dataProvider getContainsData
     */
    public function testContains($expected, $value, $collection)
    {
        $this->assertSame($expected, Phamda::contains($value, $collection));
        $curried0 = Phamda::contains();
        $this->assertSame($expected, $curried0($value, $collection));
        $curried1 = Phamda::contains($value);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getCurryData
     */
    public function testCurry($expected, callable $function, ... $initialArguments)
    {
        $this->assertSame($expected, Phamda::curry($function, ...$initialArguments));
        $curried0 = Phamda::curry();
        $this->assertSame($expected, $curried0($function, ...$initialArguments));
        $curried1 = Phamda::curry($function);
        $this->assertSame($expected, $curried1(...$initialArguments));
    }

    /**
     * @dataProvider getCurryNData
     */
    public function testCurryN($expected, $length, callable $function, ... $initialArguments)
    {
        $this->assertSame($expected, Phamda::curryN($length, $function, ...$initialArguments));
        $curried0 = Phamda::curryN();
        $this->assertSame($expected, $curried0($length, $function, ...$initialArguments));
        $curried1 = Phamda::curryN($length);
        $this->assertSame($expected, $curried1($function, ...$initialArguments));
        $curried2 = Phamda::curryN($length, $function);
        $this->assertSame($expected, $curried2(...$initialArguments));
    }

    /**
     * @dataProvider getDecData
     */
    public function testDec($expected, $number)
    {
        $this->assertSame($expected, Phamda::dec($number));
        $curried0 = Phamda::dec();
        $this->assertSame($expected, $curried0($number));
    }

    /**
     * @dataProvider getDefaultToData
     */
    public function testDefaultTo($expected, $default, $value)
    {
        $this->assertSame($expected, Phamda::defaultTo($default, $value));
        $curried0 = Phamda::defaultTo();
        $this->assertSame($expected, $curried0($default, $value));
        $curried1 = Phamda::defaultTo($default);
        $this->assertSame($expected, $curried1($value));
    }

    /**
     * @dataProvider getDivideData
     */
    public function testDivide($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::divide($x, $y));
        $curried0 = Phamda::divide();
        $this->assertSame($expected, $curried0($x, $y));
        $curried1 = Phamda::divide($x);
        $this->assertSame($expected, $curried1($y));
    }

    /**
     * @dataProvider getEitherData
     */
    public function testEither($expected, callable $a, callable $b, ... $arguments)
    {
        $main0 = Phamda::either($a, $b);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::either();
        $main1    = $curried0($a, $b);
        $this->assertSame($expected, $main1(...$arguments));
        $curried1 = Phamda::either($a);
        $main2    = $curried1($b);
        $this->assertSame($expected, $main2(...$arguments));
    }

    /**
     * @dataProvider getEqData
     */
    public function testEq($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::eq($x, $y));
        $curried0 = Phamda::eq();
        $this->assertSame($expected, $curried0($x, $y));
        $curried1 = Phamda::eq($x);
        $this->assertSame($expected, $curried1($y));
    }

    /**
     * @dataProvider getFalseData
     */
    public function testFalse($expected)
    {
        $main0 = Phamda::false();
        $this->assertSame($expected, $main0());
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilter($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::filter($predicate, $collection));
        $curried0 = Phamda::filter();
        $this->assertSame($expected, $curried0($predicate, $collection));
        $curried1 = Phamda::filter($predicate);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getFindData
     */
    public function testFind($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::find($predicate, $collection));
        $curried0 = Phamda::find();
        $this->assertSame($expected, $curried0($predicate, $collection));
        $curried1 = Phamda::find($predicate);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getFindIndexData
     */
    public function testFindIndex($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::findIndex($predicate, $collection));
        $curried0 = Phamda::findIndex();
        $this->assertSame($expected, $curried0($predicate, $collection));
        $curried1 = Phamda::findIndex($predicate);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getFindLastData
     */
    public function testFindLast($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::findLast($predicate, $collection));
        $curried0 = Phamda::findLast();
        $this->assertSame($expected, $curried0($predicate, $collection));
        $curried1 = Phamda::findLast($predicate);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getFindLastIndexData
     */
    public function testFindLastIndex($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::findLastIndex($predicate, $collection));
        $curried0 = Phamda::findLastIndex();
        $this->assertSame($expected, $curried0($predicate, $collection));
        $curried1 = Phamda::findLastIndex($predicate);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getFirstData
     */
    public function testFirst($expected, $collection)
    {
        $this->assertSame($expected, Phamda::first($collection));
        $curried0 = Phamda::first();
        $this->assertSame($expected, $curried0($collection));
    }

    /**
     * @dataProvider getFlipData
     */
    public function testFlip($expected, callable $function, $a, $b, ... $arguments)
    {
        $main0 = Phamda::flip($function);
        $this->assertSame($expected, $main0($a, $b, ...$arguments));
        $curried0 = Phamda::flip();
        $main1    = $curried0($function);
        $this->assertSame($expected, $main1($a, $b, ...$arguments));
    }

    /**
     * @dataProvider getGroupByData
     */
    public function testGroupBy($expected, callable $function, $collection)
    {
        $this->assertSame($expected, Phamda::groupBy($function, $collection));
        $curried0 = Phamda::groupBy();
        $this->assertSame($expected, $curried0($function, $collection));
        $curried1 = Phamda::groupBy($function);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getGtData
     */
    public function testGt($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::gt($x, $y));
        $curried0 = Phamda::gt();
        $this->assertSame($expected, $curried0($x, $y));
        $curried1 = Phamda::gt($x);
        $this->assertSame($expected, $curried1($y));
    }

    /**
     * @dataProvider getGteData
     */
    public function testGte($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::gte($x, $y));
        $curried0 = Phamda::gte();
        $this->assertSame($expected, $curried0($x, $y));
        $curried1 = Phamda::gte($x);
        $this->assertSame($expected, $curried1($y));
    }

    /**
     * @dataProvider getIdentityData
     */
    public function testIdentity($expected, $x)
    {
        $this->assertSame($expected, Phamda::identity($x));
        $curried0 = Phamda::identity();
        $this->assertSame($expected, $curried0($x));
    }

    /**
     * @dataProvider getIfElseData
     */
    public function testIfElse($expected, callable $condition, callable $onTrue, callable $onFalse, ... $arguments)
    {
        $main0 = Phamda::ifElse($condition, $onTrue, $onFalse);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::ifElse();
        $main1    = $curried0($condition, $onTrue, $onFalse);
        $this->assertSame($expected, $main1(...$arguments));
        $curried1 = Phamda::ifElse($condition);
        $main2    = $curried1($onTrue, $onFalse);
        $this->assertSame($expected, $main2(...$arguments));
        $curried2 = Phamda::ifElse($condition, $onTrue);
        $main3    = $curried2($onFalse);
        $this->assertSame($expected, $main3(...$arguments));
    }

    /**
     * @dataProvider getIncData
     */
    public function testInc($expected, $number)
    {
        $this->assertSame($expected, Phamda::inc($number));
        $curried0 = Phamda::inc();
        $this->assertSame($expected, $curried0($number));
    }

    /**
     * @dataProvider getIndexOfData
     */
    public function testIndexOf($expected, $item, $collection)
    {
        $this->assertSame($expected, Phamda::indexOf($item, $collection));
        $curried0 = Phamda::indexOf();
        $this->assertSame($expected, $curried0($item, $collection));
        $curried1 = Phamda::indexOf($item);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getIsEmptyData
     */
    public function testIsEmpty($expected, $collection)
    {
        $this->assertSame($expected, Phamda::isEmpty($collection));
        $curried0 = Phamda::isEmpty();
        $this->assertSame($expected, $curried0($collection));
    }

    /**
     * @dataProvider getIsInstanceData
     */
    public function testIsInstance($expected, $class, $object)
    {
        $this->assertSame($expected, Phamda::isInstance($class, $object));
        $curried0 = Phamda::isInstance();
        $this->assertSame($expected, $curried0($class, $object));
        $curried1 = Phamda::isInstance($class);
        $this->assertSame($expected, $curried1($object));
    }

    /**
     * @dataProvider getLastData
     */
    public function testLast($expected, $collection)
    {
        $this->assertSame($expected, Phamda::last($collection));
        $curried0 = Phamda::last();
        $this->assertSame($expected, $curried0($collection));
    }

    /**
     * @dataProvider getLtData
     */
    public function testLt($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::lt($x, $y));
        $curried0 = Phamda::lt();
        $this->assertSame($expected, $curried0($x, $y));
        $curried1 = Phamda::lt($x);
        $this->assertSame($expected, $curried1($y));
    }

    /**
     * @dataProvider getLteData
     */
    public function testLte($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::lte($x, $y));
        $curried0 = Phamda::lte();
        $this->assertSame($expected, $curried0($x, $y));
        $curried1 = Phamda::lte($x);
        $this->assertSame($expected, $curried1($y));
    }

    /**
     * @dataProvider getMapData
     */
    public function testMap($expected, callable $function, $collection)
    {
        $this->assertSame($expected, Phamda::map($function, $collection));
        $curried0 = Phamda::map();
        $this->assertSame($expected, $curried0($function, $collection));
        $curried1 = Phamda::map($function);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getMaxData
     */
    public function testMax($expected, $collection)
    {
        $this->assertSame($expected, Phamda::max($collection));
        $curried0 = Phamda::max();
        $this->assertSame($expected, $curried0($collection));
    }

    /**
     * @dataProvider getMaxByData
     */
    public function testMaxBy($expected, callable $getValue, $collection)
    {
        $this->assertSame($expected, Phamda::maxBy($getValue, $collection));
        $curried0 = Phamda::maxBy();
        $this->assertSame($expected, $curried0($getValue, $collection));
        $curried1 = Phamda::maxBy($getValue);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getMinData
     */
    public function testMin($expected, $collection)
    {
        $this->assertSame($expected, Phamda::min($collection));
        $curried0 = Phamda::min();
        $this->assertSame($expected, $curried0($collection));
    }

    /**
     * @dataProvider getMinByData
     */
    public function testMinBy($expected, callable $getValue, $collection)
    {
        $this->assertSame($expected, Phamda::minBy($getValue, $collection));
        $curried0 = Phamda::minBy();
        $this->assertSame($expected, $curried0($getValue, $collection));
        $curried1 = Phamda::minBy($getValue);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getModuloData
     */
    public function testModulo($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::modulo($x, $y));
        $curried0 = Phamda::modulo();
        $this->assertSame($expected, $curried0($x, $y));
        $curried1 = Phamda::modulo($x);
        $this->assertSame($expected, $curried1($y));
    }

    /**
     * @dataProvider getMultiplyData
     */
    public function testMultiply($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::multiply($x, $y));
        $curried0 = Phamda::multiply();
        $this->assertSame($expected, $curried0($x, $y));
        $curried1 = Phamda::multiply($x);
        $this->assertSame($expected, $curried1($y));
    }

    /**
     * @dataProvider getNegateData
     */
    public function testNegate($expected, $x)
    {
        $this->assertSame($expected, Phamda::negate($x));
        $curried0 = Phamda::negate();
        $this->assertSame($expected, $curried0($x));
    }

    /**
     * @dataProvider getNoneData
     */
    public function testNone($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::none($predicate, $collection));
        $curried0 = Phamda::none();
        $this->assertSame($expected, $curried0($predicate, $collection));
        $curried1 = Phamda::none($predicate);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getNotData
     */
    public function testNot($expected, callable $predicate, ... $arguments)
    {
        $main0 = Phamda::not($predicate);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::not();
        $main1    = $curried0($predicate);
        $this->assertSame($expected, $main1(...$arguments));
    }

    /**
     * @dataProvider getPartitionData
     */
    public function testPartition($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::partition($predicate, $collection));
        $curried0 = Phamda::partition();
        $this->assertSame($expected, $curried0($predicate, $collection));
        $curried1 = Phamda::partition($predicate);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getPathData
     */
    public function testPath($expected, array $path, $object)
    {
        $this->assertSame($expected, Phamda::path($path, $object));
        $curried0 = Phamda::path();
        $this->assertSame($expected, $curried0($path, $object));
        $curried1 = Phamda::path($path);
        $this->assertSame($expected, $curried1($object));
    }

    /**
     * @dataProvider getPathEqData
     */
    public function testPathEq($expected, array $path, $value, $object)
    {
        $this->assertSame($expected, Phamda::pathEq($path, $value, $object));
        $curried0 = Phamda::pathEq();
        $this->assertSame($expected, $curried0($path, $value, $object));
        $curried1 = Phamda::pathEq($path);
        $this->assertSame($expected, $curried1($value, $object));
        $curried2 = Phamda::pathEq($path, $value);
        $this->assertSame($expected, $curried2($object));
    }

    /**
     * @dataProvider getPickData
     */
    public function testPick($expected, array $names, array $item)
    {
        $this->assertSame($expected, Phamda::pick($names, $item));
        $curried0 = Phamda::pick();
        $this->assertSame($expected, $curried0($names, $item));
        $curried1 = Phamda::pick($names);
        $this->assertSame($expected, $curried1($item));
    }

    /**
     * @dataProvider getPickAllData
     */
    public function testPickAll($expected, array $names, array $item)
    {
        $this->assertSame($expected, Phamda::pickAll($names, $item));
        $curried0 = Phamda::pickAll();
        $this->assertSame($expected, $curried0($names, $item));
        $curried1 = Phamda::pickAll($names);
        $this->assertSame($expected, $curried1($item));
    }

    /**
     * @dataProvider getPipeData
     */
    public function testPipe($expected, array $functions, ... $arguments)
    {
        $main0 = Phamda::pipe(...$functions);
        $this->assertSame($expected, $main0(...$arguments));
    }

    /**
     * @dataProvider getPluckData
     */
    public function testPluck($expected, $name, $collection)
    {
        $this->assertSame($expected, Phamda::pluck($name, $collection));
        $curried0 = Phamda::pluck();
        $this->assertSame($expected, $curried0($name, $collection));
        $curried1 = Phamda::pluck($name);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getProductData
     */
    public function testProduct($expected, $values)
    {
        $this->assertSame($expected, Phamda::product($values));
        $curried0 = Phamda::product();
        $this->assertSame($expected, $curried0($values));
    }

    /**
     * @dataProvider getPropData
     */
    public function testProp($expected, $name, $object)
    {
        $this->assertSame($expected, Phamda::prop($name, $object));
        $curried0 = Phamda::prop();
        $this->assertSame($expected, $curried0($name, $object));
        $curried1 = Phamda::prop($name);
        $this->assertSame($expected, $curried1($object));
    }

    /**
     * @dataProvider getPropEqData
     */
    public function testPropEq($expected, $name, $value, $object)
    {
        $this->assertSame($expected, Phamda::propEq($name, $value, $object));
        $curried0 = Phamda::propEq();
        $this->assertSame($expected, $curried0($name, $value, $object));
        $curried1 = Phamda::propEq($name);
        $this->assertSame($expected, $curried1($value, $object));
        $curried2 = Phamda::propEq($name, $value);
        $this->assertSame($expected, $curried2($object));
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduce($expected, callable $function, $initial, $collection)
    {
        $this->assertSame($expected, Phamda::reduce($function, $initial, $collection));
        $curried0 = Phamda::reduce();
        $this->assertSame($expected, $curried0($function, $initial, $collection));
        $curried1 = Phamda::reduce($function);
        $this->assertSame($expected, $curried1($initial, $collection));
        $curried2 = Phamda::reduce($function, $initial);
        $this->assertSame($expected, $curried2($collection));
    }

    /**
     * @dataProvider getReduceRightData
     */
    public function testReduceRight($expected, callable $function, $initial, $collection)
    {
        $this->assertSame($expected, Phamda::reduceRight($function, $initial, $collection));
        $curried0 = Phamda::reduceRight();
        $this->assertSame($expected, $curried0($function, $initial, $collection));
        $curried1 = Phamda::reduceRight($function);
        $this->assertSame($expected, $curried1($initial, $collection));
        $curried2 = Phamda::reduceRight($function, $initial);
        $this->assertSame($expected, $curried2($collection));
    }

    /**
     * @dataProvider getRejectData
     */
    public function testReject($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, Phamda::reject($predicate, $collection));
        $curried0 = Phamda::reject();
        $this->assertSame($expected, $curried0($predicate, $collection));
        $curried1 = Phamda::reject($predicate);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getReverseData
     */
    public function testReverse($expected, $collection)
    {
        $this->assertSame($expected, Phamda::reverse($collection));
        $curried0 = Phamda::reverse();
        $this->assertSame($expected, $curried0($collection));
    }

    /**
     * @dataProvider getSliceData
     */
    public function testSlice($expected, $start, $end, $collection)
    {
        $this->assertSame($expected, Phamda::slice($start, $end, $collection));
        $curried0 = Phamda::slice();
        $this->assertSame($expected, $curried0($start, $end, $collection));
        $curried1 = Phamda::slice($start);
        $this->assertSame($expected, $curried1($end, $collection));
        $curried2 = Phamda::slice($start, $end);
        $this->assertSame($expected, $curried2($collection));
    }

    /**
     * @dataProvider getSortData
     */
    public function testSort($expected, callable $comparator, $collection)
    {
        $this->assertSame($expected, Phamda::sort($comparator, $collection));
        $curried0 = Phamda::sort();
        $this->assertSame($expected, $curried0($comparator, $collection));
        $curried1 = Phamda::sort($comparator);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getSortByData
     */
    public function testSortBy($expected, callable $function, $collection)
    {
        $this->assertSame($expected, Phamda::sortBy($function, $collection));
        $curried0 = Phamda::sortBy();
        $this->assertSame($expected, $curried0($function, $collection));
        $curried1 = Phamda::sortBy($function);
        $this->assertSame($expected, $curried1($collection));
    }

    /**
     * @dataProvider getSubtractData
     */
    public function testSubtract($expected, $x, $y)
    {
        $this->assertSame($expected, Phamda::subtract($x, $y));
        $curried0 = Phamda::subtract();
        $this->assertSame($expected, $curried0($x, $y));
        $curried1 = Phamda::subtract($x);
        $this->assertSame($expected, $curried1($y));
    }

    /**
     * @dataProvider getSumData
     */
    public function testSum($expected, $values)
    {
        $this->assertSame($expected, Phamda::sum($values));
        $curried0 = Phamda::sum();
        $this->assertSame($expected, $curried0($values));
    }

    /**
     * @dataProvider getTapData
     */
    public function testTap($expected, callable $function, $object)
    {
        $this->assertSame($expected, Phamda::tap($function, $object));
        $curried0 = Phamda::tap();
        $this->assertSame($expected, $curried0($function, $object));
        $curried1 = Phamda::tap($function);
        $this->assertSame($expected, $curried1($object));
    }

    /**
     * @dataProvider getTimesData
     */
    public function testTimes($expected, callable $function, $count)
    {
        $this->assertSame($expected, Phamda::times($function, $count));
        $curried0 = Phamda::times();
        $this->assertSame($expected, $curried0($function, $count));
        $curried1 = Phamda::times($function);
        $this->assertSame($expected, $curried1($count));
    }

    /**
     * @dataProvider getTrueData
     */
    public function testTrue($expected)
    {
        $main0 = Phamda::true();
        $this->assertSame($expected, $main0());
    }

    /**
     * @dataProvider getWhereData
     */
    public function testWhere($expected, array $specification, $object)
    {
        $this->assertSame($expected, Phamda::where($specification, $object));
        $curried0 = Phamda::where();
        $this->assertSame($expected, $curried0($specification, $object));
        $curried1 = Phamda::where($specification);
        $this->assertSame($expected, $curried1($object));
    }

    /**
     * @dataProvider getZipData
     */
    public function testZip($expected, array $a, array $b)
    {
        $this->assertSame($expected, Phamda::zip($a, $b));
        $curried0 = Phamda::zip();
        $this->assertSame($expected, $curried0($a, $b));
        $curried1 = Phamda::zip($a);
        $this->assertSame($expected, $curried1($b));
    }

    /**
     * @dataProvider getZipWithData
     */
    public function testZipWith($expected, callable $function, array $a, array $b)
    {
        $this->assertSame($expected, Phamda::zipWith($function, $a, $b));
        $curried0 = Phamda::zipWith();
        $this->assertSame($expected, $curried0($function, $a, $b));
        $curried1 = Phamda::zipWith($function);
        $this->assertSame($expected, $curried1($a, $b));
        $curried2 = Phamda::zipWith($function, $a);
        $this->assertSame($expected, $curried2($b));
    }
}
