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

use Phamda\Phamda as P;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for basic functionality and currying.
 *
 * This class is automatically generated using the `\Phamda\CodeGen\Builder\InnerFunctions` class.
 *
 * For details about the code generation, please see the build directory.
 */
class BasicTest extends TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getAddData
     */
    public function testAdd($expected, $x, $y)
    {
        self::assertSame($expected, P::add($x, $y), 'add produces correct results.');
        self::assertSame($expected, P::add()($x)($y), 'add is curried correctly.');
        self::assertSame($expected, P::add($x)($y), 'add is curried correctly.');
    }

    /**
     * @dataProvider getAllData
     */
    public function testAll($expected, callable $predicate, $collection)
    {
        self::assertSame($expected, P::all($predicate, $collection), 'all produces correct results.');
        self::assertSame($expected, P::all()($predicate)($collection), 'all is curried correctly.');
        self::assertSame($expected, P::all($predicate)($collection), 'all is curried correctly.');
    }

    /**
     * @dataProvider getAllPassData
     */
    public function testAllPass($expected, array $predicates, array $arguments)
    {
        self::assertSame($expected, P::allPass($predicates)(...$arguments), 'allPass produces correct results.');
        self::assertSame($expected, P::allPass()($predicates)(...$arguments), 'allPass is curried correctly.');
    }

    /**
     * @dataProvider getAlwaysData
     */
    public function testAlways($expected, $value)
    {
        self::assertSame($expected, P::always($value)(), 'always produces correct results.');
        self::assertSame($expected, P::always()($value)(), 'always is curried correctly.');
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAny($expected, callable $predicate, $collection)
    {
        self::assertSame($expected, P::any($predicate, $collection), 'any produces correct results.');
        self::assertSame($expected, P::any()($predicate)($collection), 'any is curried correctly.');
        self::assertSame($expected, P::any($predicate)($collection), 'any is curried correctly.');
    }

    /**
     * @dataProvider getAnyPassData
     */
    public function testAnyPass($expected, array $predicates, array $arguments)
    {
        self::assertSame($expected, P::anyPass($predicates)(...$arguments), 'anyPass produces correct results.');
        self::assertSame($expected, P::anyPass()($predicates)(...$arguments), 'anyPass is curried correctly.');
    }

    /**
     * @dataProvider getAppendData
     */
    public function testAppend($expected, $item, $collection)
    {
        self::assertSame($expected, P::append($item, $collection), 'append produces correct results.');
        self::assertSame($expected, P::append()($item)($collection), 'append is curried correctly.');
        self::assertSame($expected, P::append($item)($collection), 'append is curried correctly.');
    }

    /**
     * @dataProvider getApplyData
     */
    public function testApply($expected, callable $function, array $arguments)
    {
        self::assertSame($expected, P::apply($function, $arguments), 'apply produces correct results.');
        self::assertSame($expected, P::apply()($function)($arguments), 'apply is curried correctly.');
        self::assertSame($expected, P::apply($function)($arguments), 'apply is curried correctly.');
    }

    /**
     * @dataProvider getAssocData
     */
    public function testAssoc($expected, string $property, $value, $object)
    {
        self::assertSame($expected, P::assoc($property, $value, $object), 'assoc produces correct results.');
        self::assertSame($expected, P::assoc()($property)($value)($object), 'assoc is curried correctly.');
        self::assertSame($expected, P::assoc($property)($value)($object), 'assoc is curried correctly.');
        self::assertSame($expected, P::assoc($property, $value)($object), 'assoc is curried correctly.');
    }

    /**
     * @dataProvider getAssocPathData
     */
    public function testAssocPath($expected, array $path, $value, $object)
    {
        self::assertSame($expected, P::assocPath($path, $value, $object), 'assocPath produces correct results.');
        self::assertSame($expected, P::assocPath()($path)($value)($object), 'assocPath is curried correctly.');
        self::assertSame($expected, P::assocPath($path)($value)($object), 'assocPath is curried correctly.');
        self::assertSame($expected, P::assocPath($path, $value)($object), 'assocPath is curried correctly.');
    }

    /**
     * @dataProvider getBinaryData
     */
    public function testBinary($expected, callable $function, $a, $b)
    {
        self::assertSame($expected, P::binary($function)($a, $b), 'binary produces correct results.');
        self::assertSame($expected, P::binary()($function)($a, $b), 'binary is curried correctly.');
    }

    /**
     * @dataProvider getBothData
     */
    public function testBoth($expected, callable $a, callable $b, array $arguments)
    {
        self::assertSame($expected, P::both($a, $b)(...$arguments), 'both produces correct results.');
        self::assertSame($expected, P::both()($a)($b)(...$arguments), 'both is curried correctly.');
        self::assertSame($expected, P::both($a)($b)(...$arguments), 'both is curried correctly.');
    }

    /**
     * @dataProvider getCastData
     */
    public function testCast($expected, string $type, $value)
    {
        self::assertSame($expected, P::cast($type, $value), 'cast produces correct results.');
        self::assertSame($expected, P::cast()($type)($value), 'cast is curried correctly.');
        self::assertSame($expected, P::cast($type)($value), 'cast is curried correctly.');
    }

    /**
     * @dataProvider getComparatorData
     */
    public function testComparator($expected, callable $predicate, $x, $y)
    {
        self::assertSame($expected, P::comparator($predicate)($x, $y), 'comparator produces correct results.');
        self::assertSame($expected, P::comparator()($predicate)($x, $y), 'comparator is curried correctly.');
    }

    /**
     * @dataProvider getComposeData
     */
    public function testCompose($expected, array $functions, array $arguments)
    {
        self::assertSame($expected, P::compose(...$functions)(...$arguments), 'compose produces correct results.');
    }

    /**
     * @dataProvider getConcatData
     */
    public function testConcat($expected, string $a, string $b)
    {
        self::assertSame($expected, P::concat($a, $b), 'concat produces correct results.');
        self::assertSame($expected, P::concat()($a)($b), 'concat is curried correctly.');
        self::assertSame($expected, P::concat($a)($b), 'concat is curried correctly.');
    }

    /**
     * @dataProvider getContainsData
     */
    public function testContains($expected, $value, $collection)
    {
        self::assertSame($expected, P::contains($value, $collection), 'contains produces correct results.');
        self::assertSame($expected, P::contains()($value)($collection), 'contains is curried correctly.');
        self::assertSame($expected, P::contains($value)($collection), 'contains is curried correctly.');
    }

    /**
     * @dataProvider getCurryData
     */
    public function testCurry($expected, callable $function, array $initialArguments)
    {
        self::assertSame($expected, P::curry($function, ...$initialArguments), 'curry produces correct results.');
        self::assertSame($expected, P::curry()($function)(...$initialArguments), 'curry is curried correctly.');
        self::assertSame($expected, P::curry($function)(...$initialArguments), 'curry is curried correctly.');
    }

    /**
     * @dataProvider getCurryNData
     */
    public function testCurryN($expected, int $length, callable $function, array $initialArguments)
    {
        self::assertSame($expected, P::curryN($length, $function, ...$initialArguments), 'curryN produces correct results.');
        self::assertSame($expected, P::curryN()($length)($function)(...$initialArguments), 'curryN is curried correctly.');
        self::assertSame($expected, P::curryN($length)($function)(...$initialArguments), 'curryN is curried correctly.');
        self::assertSame($expected, P::curryN($length, $function)(...$initialArguments), 'curryN is curried correctly.');
    }

    /**
     * @dataProvider getDefaultToData
     */
    public function testDefaultTo($expected, $default, $value)
    {
        self::assertSame($expected, P::defaultTo($default, $value), 'defaultTo produces correct results.');
        self::assertSame($expected, P::defaultTo()($default)($value), 'defaultTo is curried correctly.');
        self::assertSame($expected, P::defaultTo($default)($value), 'defaultTo is curried correctly.');
    }

    /**
     * @dataProvider getDivideData
     */
    public function testDivide($expected, $x, $y)
    {
        self::assertSame($expected, P::divide($x, $y), 'divide produces correct results.');
        self::assertSame($expected, P::divide()($x)($y), 'divide is curried correctly.');
        self::assertSame($expected, P::divide($x)($y), 'divide is curried correctly.');
    }

    /**
     * @dataProvider getEachData
     */
    public function testEach($expected, callable $function, $collection)
    {
        self::assertSame($expected, P::each($function, $collection), 'each produces correct results.');
        self::assertSame($expected, P::each()($function)($collection), 'each is curried correctly.');
        self::assertSame($expected, P::each($function)($collection), 'each is curried correctly.');
    }

    /**
     * @dataProvider getEitherData
     */
    public function testEither($expected, callable $a, callable $b, array $arguments)
    {
        self::assertSame($expected, P::either($a, $b)(...$arguments), 'either produces correct results.');
        self::assertSame($expected, P::either()($a)($b)(...$arguments), 'either is curried correctly.');
        self::assertSame($expected, P::either($a)($b)(...$arguments), 'either is curried correctly.');
    }

    /**
     * @dataProvider getEqData
     */
    public function testEq($expected, $x, $y)
    {
        self::assertSame($expected, P::eq($x, $y), 'eq produces correct results.');
        self::assertSame($expected, P::eq()($x)($y), 'eq is curried correctly.');
        self::assertSame($expected, P::eq($x)($y), 'eq is curried correctly.');
    }

    /**
     * @dataProvider getEvolveData
     */
    public function testEvolve($expected, array $transformations, $object)
    {
        self::assertSame($expected, P::evolve($transformations, $object), 'evolve produces correct results.');
        self::assertSame($expected, P::evolve()($transformations)($object), 'evolve is curried correctly.');
        self::assertSame($expected, P::evolve($transformations)($object), 'evolve is curried correctly.');
    }

    /**
     * @dataProvider getExplodeData
     */
    public function testExplode($expected, string $delimiter, string $string)
    {
        self::assertSame($expected, P::explode($delimiter, $string), 'explode produces correct results.');
        self::assertSame($expected, P::explode()($delimiter)($string), 'explode is curried correctly.');
        self::assertSame($expected, P::explode($delimiter)($string), 'explode is curried correctly.');
    }

    /**
     * @dataProvider getFalseData
     */
    public function testFalse($expected)
    {
        self::assertSame($expected, P::false()(), 'false produces correct results.');
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilter($expected, callable $predicate, $collection)
    {
        self::assertSame($expected, P::filter($predicate, $collection), 'filter produces correct results.');
        self::assertSame($expected, P::filter()($predicate)($collection), 'filter is curried correctly.');
        self::assertSame($expected, P::filter($predicate)($collection), 'filter is curried correctly.');
    }

    /**
     * @dataProvider getFindData
     */
    public function testFind($expected, callable $predicate, $collection)
    {
        self::assertSame($expected, P::find($predicate, $collection), 'find produces correct results.');
        self::assertSame($expected, P::find()($predicate)($collection), 'find is curried correctly.');
        self::assertSame($expected, P::find($predicate)($collection), 'find is curried correctly.');
    }

    /**
     * @dataProvider getFindIndexData
     */
    public function testFindIndex($expected, callable $predicate, $collection)
    {
        self::assertSame($expected, P::findIndex($predicate, $collection), 'findIndex produces correct results.');
        self::assertSame($expected, P::findIndex()($predicate)($collection), 'findIndex is curried correctly.');
        self::assertSame($expected, P::findIndex($predicate)($collection), 'findIndex is curried correctly.');
    }

    /**
     * @dataProvider getFindLastData
     */
    public function testFindLast($expected, callable $predicate, $collection)
    {
        self::assertSame($expected, P::findLast($predicate, $collection), 'findLast produces correct results.');
        self::assertSame($expected, P::findLast()($predicate)($collection), 'findLast is curried correctly.');
        self::assertSame($expected, P::findLast($predicate)($collection), 'findLast is curried correctly.');
    }

    /**
     * @dataProvider getFindLastIndexData
     */
    public function testFindLastIndex($expected, callable $predicate, $collection)
    {
        self::assertSame($expected, P::findLastIndex($predicate, $collection), 'findLastIndex produces correct results.');
        self::assertSame($expected, P::findLastIndex()($predicate)($collection), 'findLastIndex is curried correctly.');
        self::assertSame($expected, P::findLastIndex($predicate)($collection), 'findLastIndex is curried correctly.');
    }

    /**
     * @dataProvider getFirstData
     */
    public function testFirst($expected, $collection)
    {
        self::assertSame($expected, P::first($collection), 'first produces correct results.');
        self::assertSame($expected, P::first()($collection), 'first is curried correctly.');
    }

    /**
     * @dataProvider getFlatMapData
     */
    public function testFlatMap($expected, callable $function, array $list)
    {
        self::assertSame($expected, P::flatMap($function, $list), 'flatMap produces correct results.');
        self::assertSame($expected, P::flatMap()($function)($list), 'flatMap is curried correctly.');
        self::assertSame($expected, P::flatMap($function)($list), 'flatMap is curried correctly.');
    }

    /**
     * @dataProvider getFlattenData
     */
    public function testFlatten($expected, array $list)
    {
        self::assertSame($expected, P::flatten($list), 'flatten produces correct results.');
        self::assertSame($expected, P::flatten()($list), 'flatten is curried correctly.');
    }

    /**
     * @dataProvider getFlattenLevelData
     */
    public function testFlattenLevel($expected, array $list)
    {
        self::assertSame($expected, P::flattenLevel($list), 'flattenLevel produces correct results.');
        self::assertSame($expected, P::flattenLevel()($list), 'flattenLevel is curried correctly.');
    }

    /**
     * @dataProvider getFlipData
     */
    public function testFlip($expected, callable $function, $a, $b, array $arguments)
    {
        self::assertSame($expected, P::flip($function)($a, $b, ...$arguments), 'flip produces correct results.');
        self::assertSame($expected, P::flip()($function)($a, $b, ...$arguments), 'flip is curried correctly.');
    }

    /**
     * @dataProvider getFromPairsData
     */
    public function testFromPairs($expected, $list)
    {
        self::assertSame($expected, P::fromPairs($list), 'fromPairs produces correct results.');
        self::assertSame($expected, P::fromPairs()($list), 'fromPairs is curried correctly.');
    }

    /**
     * @dataProvider getGroupByData
     */
    public function testGroupBy($expected, callable $function, $collection)
    {
        self::assertSame($expected, P::groupBy($function, $collection), 'groupBy produces correct results.');
        self::assertSame($expected, P::groupBy()($function)($collection), 'groupBy is curried correctly.');
        self::assertSame($expected, P::groupBy($function)($collection), 'groupBy is curried correctly.');
    }

    /**
     * @dataProvider getGtData
     */
    public function testGt($expected, $x, $y)
    {
        self::assertSame($expected, P::gt($x, $y), 'gt produces correct results.');
        self::assertSame($expected, P::gt()($x)($y), 'gt is curried correctly.');
        self::assertSame($expected, P::gt($x)($y), 'gt is curried correctly.');
    }

    /**
     * @dataProvider getGteData
     */
    public function testGte($expected, $x, $y)
    {
        self::assertSame($expected, P::gte($x, $y), 'gte produces correct results.');
        self::assertSame($expected, P::gte()($x)($y), 'gte is curried correctly.');
        self::assertSame($expected, P::gte($x)($y), 'gte is curried correctly.');
    }

    /**
     * @dataProvider getIdentityData
     */
    public function testIdentity($expected, $x)
    {
        self::assertSame($expected, P::identity($x), 'identity produces correct results.');
        self::assertSame($expected, P::identity()($x), 'identity is curried correctly.');
    }

    /**
     * @dataProvider getIfElseData
     */
    public function testIfElse($expected, callable $condition, callable $onTrue, callable $onFalse, array $arguments)
    {
        self::assertSame($expected, P::ifElse($condition, $onTrue, $onFalse)(...$arguments), 'ifElse produces correct results.');
        self::assertSame($expected, P::ifElse()($condition)($onTrue)($onFalse)(...$arguments), 'ifElse is curried correctly.');
        self::assertSame($expected, P::ifElse($condition)($onTrue)($onFalse)(...$arguments), 'ifElse is curried correctly.');
        self::assertSame($expected, P::ifElse($condition, $onTrue)($onFalse)(...$arguments), 'ifElse is curried correctly.');
    }

    /**
     * @dataProvider getImplodeData
     */
    public function testImplode($expected, string $glue, array $strings)
    {
        self::assertSame($expected, P::implode($glue, $strings), 'implode produces correct results.');
        self::assertSame($expected, P::implode()($glue)($strings), 'implode is curried correctly.');
        self::assertSame($expected, P::implode($glue)($strings), 'implode is curried correctly.');
    }

    /**
     * @dataProvider getIndexOfData
     */
    public function testIndexOf($expected, $item, $collection)
    {
        self::assertSame($expected, P::indexOf($item, $collection), 'indexOf produces correct results.');
        self::assertSame($expected, P::indexOf()($item)($collection), 'indexOf is curried correctly.');
        self::assertSame($expected, P::indexOf($item)($collection), 'indexOf is curried correctly.');
    }

    /**
     * @dataProvider getInvokerData
     */
    public function testInvoker($expected, int $arity, string $method, array $initialArguments, array $arguments)
    {
        self::assertSame($expected, P::invoker($arity, $method, ...$initialArguments)(...$arguments), 'invoker produces correct results.');
        self::assertSame($expected, P::invoker()($arity)($method)(...$initialArguments)(...$arguments), 'invoker is curried correctly.');
        self::assertSame($expected, P::invoker($arity)($method)(...$initialArguments)(...$arguments), 'invoker is curried correctly.');
        self::assertSame($expected, P::invoker($arity, $method)(...$initialArguments)(...$arguments), 'invoker is curried correctly.');
    }

    /**
     * @dataProvider getIsEmptyData
     */
    public function testIsEmpty($expected, $collection)
    {
        self::assertSame($expected, P::isEmpty($collection), 'isEmpty produces correct results.');
        self::assertSame($expected, P::isEmpty()($collection), 'isEmpty is curried correctly.');
    }

    /**
     * @dataProvider getIsInstanceData
     */
    public function testIsInstance($expected, string $class, $object)
    {
        self::assertSame($expected, P::isInstance($class, $object), 'isInstance produces correct results.');
        self::assertSame($expected, P::isInstance()($class)($object), 'isInstance is curried correctly.');
        self::assertSame($expected, P::isInstance($class)($object), 'isInstance is curried correctly.');
    }

    /**
     * @dataProvider getLastData
     */
    public function testLast($expected, $collection)
    {
        self::assertSame($expected, P::last($collection), 'last produces correct results.');
        self::assertSame($expected, P::last()($collection), 'last is curried correctly.');
    }

    /**
     * @dataProvider getLtData
     */
    public function testLt($expected, $x, $y)
    {
        self::assertSame($expected, P::lt($x, $y), 'lt produces correct results.');
        self::assertSame($expected, P::lt()($x)($y), 'lt is curried correctly.');
        self::assertSame($expected, P::lt($x)($y), 'lt is curried correctly.');
    }

    /**
     * @dataProvider getLteData
     */
    public function testLte($expected, $x, $y)
    {
        self::assertSame($expected, P::lte($x, $y), 'lte produces correct results.');
        self::assertSame($expected, P::lte()($x)($y), 'lte is curried correctly.');
        self::assertSame($expected, P::lte($x)($y), 'lte is curried correctly.');
    }

    /**
     * @dataProvider getMapData
     */
    public function testMap($expected, callable $function, $collection)
    {
        self::assertSame($expected, P::map($function, $collection), 'map produces correct results.');
        self::assertSame($expected, P::map()($function)($collection), 'map is curried correctly.');
        self::assertSame($expected, P::map($function)($collection), 'map is curried correctly.');
    }

    /**
     * @dataProvider getMaxData
     */
    public function testMax($expected, $collection)
    {
        self::assertSame($expected, P::max($collection), 'max produces correct results.');
        self::assertSame($expected, P::max()($collection), 'max is curried correctly.');
    }

    /**
     * @dataProvider getMaxByData
     */
    public function testMaxBy($expected, callable $getValue, $collection)
    {
        self::assertSame($expected, P::maxBy($getValue, $collection), 'maxBy produces correct results.');
        self::assertSame($expected, P::maxBy()($getValue)($collection), 'maxBy is curried correctly.');
        self::assertSame($expected, P::maxBy($getValue)($collection), 'maxBy is curried correctly.');
    }

    /**
     * @dataProvider getMergeData
     */
    public function testMerge($expected, array $a, array $b)
    {
        self::assertSame($expected, P::merge($a, $b), 'merge produces correct results.');
        self::assertSame($expected, P::merge()($a)($b), 'merge is curried correctly.');
        self::assertSame($expected, P::merge($a)($b), 'merge is curried correctly.');
    }

    /**
     * @dataProvider getMinData
     */
    public function testMin($expected, $collection)
    {
        self::assertSame($expected, P::min($collection), 'min produces correct results.');
        self::assertSame($expected, P::min()($collection), 'min is curried correctly.');
    }

    /**
     * @dataProvider getMinByData
     */
    public function testMinBy($expected, callable $getValue, $collection)
    {
        self::assertSame($expected, P::minBy($getValue, $collection), 'minBy produces correct results.');
        self::assertSame($expected, P::minBy()($getValue)($collection), 'minBy is curried correctly.');
        self::assertSame($expected, P::minBy($getValue)($collection), 'minBy is curried correctly.');
    }

    /**
     * @dataProvider getModuloData
     */
    public function testModulo($expected, int $x, int $y)
    {
        self::assertSame($expected, P::modulo($x, $y), 'modulo produces correct results.');
        self::assertSame($expected, P::modulo()($x)($y), 'modulo is curried correctly.');
        self::assertSame($expected, P::modulo($x)($y), 'modulo is curried correctly.');
    }

    /**
     * @dataProvider getMultiplyData
     */
    public function testMultiply($expected, $x, $y)
    {
        self::assertSame($expected, P::multiply($x, $y), 'multiply produces correct results.');
        self::assertSame($expected, P::multiply()($x)($y), 'multiply is curried correctly.');
        self::assertSame($expected, P::multiply($x)($y), 'multiply is curried correctly.');
    }

    /**
     * @dataProvider getNAryData
     */
    public function testNAry($expected, int $arity, callable $function, array $arguments)
    {
        self::assertSame($expected, P::nAry($arity, $function)(...$arguments), 'nAry produces correct results.');
        self::assertSame($expected, P::nAry()($arity)($function)(...$arguments), 'nAry is curried correctly.');
        self::assertSame($expected, P::nAry($arity)($function)(...$arguments), 'nAry is curried correctly.');
    }

    /**
     * @dataProvider getNegateData
     */
    public function testNegate($expected, $x)
    {
        self::assertSame($expected, P::negate($x), 'negate produces correct results.');
        self::assertSame($expected, P::negate()($x), 'negate is curried correctly.');
    }

    /**
     * @dataProvider getNoneData
     */
    public function testNone($expected, callable $predicate, $collection)
    {
        self::assertSame($expected, P::none($predicate, $collection), 'none produces correct results.');
        self::assertSame($expected, P::none()($predicate)($collection), 'none is curried correctly.');
        self::assertSame($expected, P::none($predicate)($collection), 'none is curried correctly.');
    }

    /**
     * @dataProvider getNotData
     */
    public function testNot($expected, callable $predicate, array $arguments)
    {
        self::assertSame($expected, P::not($predicate)(...$arguments), 'not produces correct results.');
        self::assertSame($expected, P::not()($predicate)(...$arguments), 'not is curried correctly.');
    }

    /**
     * @dataProvider getPartialData
     */
    public function testPartial($expected, callable $function, array $initialArguments, array $arguments)
    {
        self::assertSame($expected, P::partial($function, ...$initialArguments)(...$arguments), 'partial produces correct results.');
        self::assertSame($expected, P::partial()($function)(...$initialArguments)(...$arguments), 'partial is curried correctly.');
        self::assertSame($expected, P::partial($function)(...$initialArguments)(...$arguments), 'partial is curried correctly.');
    }

    /**
     * @dataProvider getPartialNData
     */
    public function testPartialN($expected, int $arity, callable $function, array $initialArguments, array $arguments)
    {
        self::assertSame($expected, P::partialN($arity, $function, ...$initialArguments)(...$arguments), 'partialN produces correct results.');
        self::assertSame($expected, P::partialN()($arity)($function)(...$initialArguments)(...$arguments), 'partialN is curried correctly.');
        self::assertSame($expected, P::partialN($arity)($function)(...$initialArguments)(...$arguments), 'partialN is curried correctly.');
        self::assertSame($expected, P::partialN($arity, $function)(...$initialArguments)(...$arguments), 'partialN is curried correctly.');
    }

    /**
     * @dataProvider getPartitionData
     */
    public function testPartition($expected, callable $predicate, $collection)
    {
        self::assertSame($expected, P::partition($predicate, $collection), 'partition produces correct results.');
        self::assertSame($expected, P::partition()($predicate)($collection), 'partition is curried correctly.');
        self::assertSame($expected, P::partition($predicate)($collection), 'partition is curried correctly.');
    }

    /**
     * @dataProvider getPathData
     */
    public function testPath($expected, array $path, $object)
    {
        self::assertSame($expected, P::path($path, $object), 'path produces correct results.');
        self::assertSame($expected, P::path()($path)($object), 'path is curried correctly.');
        self::assertSame($expected, P::path($path)($object), 'path is curried correctly.');
    }

    /**
     * @dataProvider getPathEqData
     */
    public function testPathEq($expected, array $path, $value, $object)
    {
        self::assertSame($expected, P::pathEq($path, $value, $object), 'pathEq produces correct results.');
        self::assertSame($expected, P::pathEq()($path)($value)($object), 'pathEq is curried correctly.');
        self::assertSame($expected, P::pathEq($path)($value)($object), 'pathEq is curried correctly.');
        self::assertSame($expected, P::pathEq($path, $value)($object), 'pathEq is curried correctly.');
    }

    /**
     * @dataProvider getPickData
     */
    public function testPick($expected, array $names, array $item)
    {
        self::assertSame($expected, P::pick($names, $item), 'pick produces correct results.');
        self::assertSame($expected, P::pick()($names)($item), 'pick is curried correctly.');
        self::assertSame($expected, P::pick($names)($item), 'pick is curried correctly.');
    }

    /**
     * @dataProvider getPickAllData
     */
    public function testPickAll($expected, array $names, array $item)
    {
        self::assertSame($expected, P::pickAll($names, $item), 'pickAll produces correct results.');
        self::assertSame($expected, P::pickAll()($names)($item), 'pickAll is curried correctly.');
        self::assertSame($expected, P::pickAll($names)($item), 'pickAll is curried correctly.');
    }

    /**
     * @dataProvider getPipeData
     */
    public function testPipe($expected, array $functions, array $arguments)
    {
        self::assertSame($expected, P::pipe(...$functions)(...$arguments), 'pipe produces correct results.');
    }

    /**
     * @dataProvider getPluckData
     */
    public function testPluck($expected, string $name, $collection)
    {
        self::assertSame($expected, P::pluck($name, $collection), 'pluck produces correct results.');
        self::assertSame($expected, P::pluck()($name)($collection), 'pluck is curried correctly.');
        self::assertSame($expected, P::pluck($name)($collection), 'pluck is curried correctly.');
    }

    /**
     * @dataProvider getPrependData
     */
    public function testPrepend($expected, $item, $collection)
    {
        self::assertSame($expected, P::prepend($item, $collection), 'prepend produces correct results.');
        self::assertSame($expected, P::prepend()($item)($collection), 'prepend is curried correctly.');
        self::assertSame($expected, P::prepend($item)($collection), 'prepend is curried correctly.');
    }

    /**
     * @dataProvider getProductData
     */
    public function testProduct($expected, $values)
    {
        self::assertSame($expected, P::product($values), 'product produces correct results.');
        self::assertSame($expected, P::product()($values), 'product is curried correctly.');
    }

    /**
     * @dataProvider getPropData
     */
    public function testProp($expected, string $name, $object)
    {
        self::assertSame($expected, P::prop($name, $object), 'prop produces correct results.');
        self::assertSame($expected, P::prop()($name)($object), 'prop is curried correctly.');
        self::assertSame($expected, P::prop($name)($object), 'prop is curried correctly.');
    }

    /**
     * @dataProvider getPropEqData
     */
    public function testPropEq($expected, string $name, $value, $object)
    {
        self::assertSame($expected, P::propEq($name, $value, $object), 'propEq produces correct results.');
        self::assertSame($expected, P::propEq()($name)($value)($object), 'propEq is curried correctly.');
        self::assertSame($expected, P::propEq($name)($value)($object), 'propEq is curried correctly.');
        self::assertSame($expected, P::propEq($name, $value)($object), 'propEq is curried correctly.');
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduce($expected, callable $function, $initial, $collection)
    {
        self::assertSame($expected, P::reduce($function, $initial, $collection), 'reduce produces correct results.');
        self::assertSame($expected, P::reduce()($function)($initial)($collection), 'reduce is curried correctly.');
        self::assertSame($expected, P::reduce($function)($initial)($collection), 'reduce is curried correctly.');
        self::assertSame($expected, P::reduce($function, $initial)($collection), 'reduce is curried correctly.');
    }

    /**
     * @dataProvider getReduceRightData
     */
    public function testReduceRight($expected, callable $function, $initial, $collection)
    {
        self::assertSame($expected, P::reduceRight($function, $initial, $collection), 'reduceRight produces correct results.');
        self::assertSame($expected, P::reduceRight()($function)($initial)($collection), 'reduceRight is curried correctly.');
        self::assertSame($expected, P::reduceRight($function)($initial)($collection), 'reduceRight is curried correctly.');
        self::assertSame($expected, P::reduceRight($function, $initial)($collection), 'reduceRight is curried correctly.');
    }

    /**
     * @dataProvider getRejectData
     */
    public function testReject($expected, callable $predicate, $collection)
    {
        self::assertSame($expected, P::reject($predicate, $collection), 'reject produces correct results.');
        self::assertSame($expected, P::reject()($predicate)($collection), 'reject is curried correctly.');
        self::assertSame($expected, P::reject($predicate)($collection), 'reject is curried correctly.');
    }

    /**
     * @dataProvider getReverseData
     */
    public function testReverse($expected, $collection)
    {
        self::assertSame($expected, P::reverse($collection), 'reverse produces correct results.');
        self::assertSame($expected, P::reverse()($collection), 'reverse is curried correctly.');
    }

    /**
     * @dataProvider getSliceData
     */
    public function testSlice($expected, int $start, int $end, $collection)
    {
        self::assertSame($expected, P::slice($start, $end, $collection), 'slice produces correct results.');
        self::assertSame($expected, P::slice()($start)($end)($collection), 'slice is curried correctly.');
        self::assertSame($expected, P::slice($start)($end)($collection), 'slice is curried correctly.');
        self::assertSame($expected, P::slice($start, $end)($collection), 'slice is curried correctly.');
    }

    /**
     * @dataProvider getSortData
     */
    public function testSort($expected, callable $comparator, $collection)
    {
        self::assertSame($expected, P::sort($comparator, $collection), 'sort produces correct results.');
        self::assertSame($expected, P::sort()($comparator)($collection), 'sort is curried correctly.');
        self::assertSame($expected, P::sort($comparator)($collection), 'sort is curried correctly.');
    }

    /**
     * @dataProvider getSortByData
     */
    public function testSortBy($expected, callable $function, $collection)
    {
        self::assertSame($expected, P::sortBy($function, $collection), 'sortBy produces correct results.');
        self::assertSame($expected, P::sortBy()($function)($collection), 'sortBy is curried correctly.');
        self::assertSame($expected, P::sortBy($function)($collection), 'sortBy is curried correctly.');
    }

    /**
     * @dataProvider getStringIndexOfData
     */
    public function testStringIndexOf($expected, string $substring, string $string)
    {
        self::assertSame($expected, P::stringIndexOf($substring, $string), 'stringIndexOf produces correct results.');
        self::assertSame($expected, P::stringIndexOf()($substring)($string), 'stringIndexOf is curried correctly.');
        self::assertSame($expected, P::stringIndexOf($substring)($string), 'stringIndexOf is curried correctly.');
    }

    /**
     * @dataProvider getStringLastIndexOfData
     */
    public function testStringLastIndexOf($expected, string $substring, string $string)
    {
        self::assertSame($expected, P::stringLastIndexOf($substring, $string), 'stringLastIndexOf produces correct results.');
        self::assertSame($expected, P::stringLastIndexOf()($substring)($string), 'stringLastIndexOf is curried correctly.');
        self::assertSame($expected, P::stringLastIndexOf($substring)($string), 'stringLastIndexOf is curried correctly.');
    }

    /**
     * @dataProvider getSubstringData
     */
    public function testSubstring($expected, int $start, int $end, string $string)
    {
        self::assertSame($expected, P::substring($start, $end, $string), 'substring produces correct results.');
        self::assertSame($expected, P::substring()($start)($end)($string), 'substring is curried correctly.');
        self::assertSame($expected, P::substring($start)($end)($string), 'substring is curried correctly.');
        self::assertSame($expected, P::substring($start, $end)($string), 'substring is curried correctly.');
    }

    /**
     * @dataProvider getSubstringFromData
     */
    public function testSubstringFrom($expected, int $start, string $string)
    {
        self::assertSame($expected, P::substringFrom($start, $string), 'substringFrom produces correct results.');
        self::assertSame($expected, P::substringFrom()($start)($string), 'substringFrom is curried correctly.');
        self::assertSame($expected, P::substringFrom($start)($string), 'substringFrom is curried correctly.');
    }

    /**
     * @dataProvider getSubstringToData
     */
    public function testSubstringTo($expected, int $end, string $string)
    {
        self::assertSame($expected, P::substringTo($end, $string), 'substringTo produces correct results.');
        self::assertSame($expected, P::substringTo()($end)($string), 'substringTo is curried correctly.');
        self::assertSame($expected, P::substringTo($end)($string), 'substringTo is curried correctly.');
    }

    /**
     * @dataProvider getSubtractData
     */
    public function testSubtract($expected, $x, $y)
    {
        self::assertSame($expected, P::subtract($x, $y), 'subtract produces correct results.');
        self::assertSame($expected, P::subtract()($x)($y), 'subtract is curried correctly.');
        self::assertSame($expected, P::subtract($x)($y), 'subtract is curried correctly.');
    }

    /**
     * @dataProvider getSumData
     */
    public function testSum($expected, $values)
    {
        self::assertSame($expected, P::sum($values), 'sum produces correct results.');
        self::assertSame($expected, P::sum()($values), 'sum is curried correctly.');
    }

    /**
     * @dataProvider getTailData
     */
    public function testTail($expected, $collection)
    {
        self::assertSame($expected, P::tail($collection), 'tail produces correct results.');
        self::assertSame($expected, P::tail()($collection), 'tail is curried correctly.');
    }

    /**
     * @dataProvider getTapData
     */
    public function testTap($expected, callable $function, $object)
    {
        self::assertSame($expected, P::tap($function, $object), 'tap produces correct results.');
        self::assertSame($expected, P::tap()($function)($object), 'tap is curried correctly.');
        self::assertSame($expected, P::tap($function)($object), 'tap is curried correctly.');
    }

    /**
     * @dataProvider getTimesData
     */
    public function testTimes($expected, callable $function, int $count)
    {
        self::assertSame($expected, P::times($function, $count), 'times produces correct results.');
        self::assertSame($expected, P::times()($function)($count), 'times is curried correctly.');
        self::assertSame($expected, P::times($function)($count), 'times is curried correctly.');
    }

    /**
     * @dataProvider getToPairsData
     */
    public function testToPairs($expected, $map)
    {
        self::assertSame($expected, P::toPairs($map), 'toPairs produces correct results.');
        self::assertSame($expected, P::toPairs()($map), 'toPairs is curried correctly.');
    }

    /**
     * @dataProvider getTrueData
     */
    public function testTrue($expected)
    {
        self::assertSame($expected, P::true()(), 'true produces correct results.');
    }

    /**
     * @dataProvider getTwistData
     */
    public function testTwist($expected, callable $function, array $arguments)
    {
        self::assertSame($expected, P::twist($function)(...$arguments), 'twist produces correct results.');
        self::assertSame($expected, P::twist()($function)(...$arguments), 'twist is curried correctly.');
    }

    /**
     * @dataProvider getTwistNData
     */
    public function testTwistN($expected, int $arity, callable $function, array $arguments)
    {
        self::assertSame($expected, P::twistN($arity, $function)(...$arguments), 'twistN produces correct results.');
        self::assertSame($expected, P::twistN()($arity)($function)(...$arguments), 'twistN is curried correctly.');
        self::assertSame($expected, P::twistN($arity)($function)(...$arguments), 'twistN is curried correctly.');
    }

    /**
     * @dataProvider getUnaryData
     */
    public function testUnary($expected, callable $function, $a)
    {
        self::assertSame($expected, P::unary($function)($a), 'unary produces correct results.');
        self::assertSame($expected, P::unary()($function)($a), 'unary is curried correctly.');
    }

    /**
     * @dataProvider getUnapplyData
     */
    public function testUnapply($expected, callable $function, array $arguments)
    {
        self::assertSame($expected, P::unapply($function, ...$arguments), 'unapply produces correct results.');
        self::assertSame($expected, P::unapply()($function)(...$arguments), 'unapply is curried correctly.');
        self::assertSame($expected, P::unapply($function)(...$arguments), 'unapply is curried correctly.');
    }

    /**
     * @dataProvider getWhereData
     */
    public function testWhere($expected, array $specification, $object)
    {
        self::assertSame($expected, P::where($specification, $object), 'where produces correct results.');
        self::assertSame($expected, P::where()($specification)($object), 'where is curried correctly.');
        self::assertSame($expected, P::where($specification)($object), 'where is curried correctly.');
    }

    /**
     * @dataProvider getZipData
     */
    public function testZip($expected, array $a, array $b)
    {
        self::assertSame($expected, P::zip($a, $b), 'zip produces correct results.');
        self::assertSame($expected, P::zip()($a)($b), 'zip is curried correctly.');
        self::assertSame($expected, P::zip($a)($b), 'zip is curried correctly.');
    }

    /**
     * @dataProvider getZipWithData
     */
    public function testZipWith($expected, callable $function, array $a, array $b)
    {
        self::assertSame($expected, P::zipWith($function, $a, $b), 'zipWith produces correct results.');
        self::assertSame($expected, P::zipWith()($function)($a)($b), 'zipWith is curried correctly.');
        self::assertSame($expected, P::zipWith($function)($a)($b), 'zipWith is curried correctly.');
        self::assertSame($expected, P::zipWith($function, $a)($b), 'zipWith is curried correctly.');
    }
}
