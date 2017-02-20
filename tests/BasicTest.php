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
 * This class is automatically generated using the `\Phamda\Builder\InnerFunctions` class.
 *
 * For details about the code generation, please see: https://github.com/mpajunen/phamda-codegen
 */
class BasicTest extends TestCase
{
    use BasicProvidersTrait, CurryTestTrait;

    /**
     * @dataProvider get_Data
     */
    public function test_($expected)
    {
        $this->assertSame($expected, P::_(), '_ produces correct results.');
    }

    /**
     * @dataProvider getAddData
     */
    public function testAdd($expected, $x, $y)
    {
        $this->assertSame($expected, P::add($x, $y), 'add produces correct results.');
        foreach ($this->getCurriedResults(P::add(), $x, $y) as $result) {
            $this->assertSame($expected, $result, 'add is curried correctly.');
        }
    }

    /**
     * @dataProvider getAllData
     */
    public function testAll($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, P::all($predicate, $collection), 'all produces correct results.');
        foreach ($this->getCurriedResults(P::all(), $predicate, $collection) as $result) {
            $this->assertSame($expected, $result, 'all is curried correctly.');
        }
    }

    /**
     * @dataProvider getAllPassData
     */
    public function testAllPass($expected, array $predicates, ...$arguments)
    {
        $main0 = P::allPass($predicates);
        $this->assertSame($expected, $main0(...$arguments), 'allPass produces correct results.');
        foreach ($this->getCurriedResults(P::allPass(), $predicates) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'allPass is curried correctly.');
        }
    }

    /**
     * @dataProvider getAlwaysData
     */
    public function testAlways($expected, $value)
    {
        $main0 = P::always($value);
        $this->assertSame($expected, $main0(), 'always produces correct results.');
        foreach ($this->getCurriedResults(P::always(), $value) as $result) {
            $this->assertSame($expected, $result(), 'always is curried correctly.');
        }
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAny($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, P::any($predicate, $collection), 'any produces correct results.');
        foreach ($this->getCurriedResults(P::any(), $predicate, $collection) as $result) {
            $this->assertSame($expected, $result, 'any is curried correctly.');
        }
    }

    /**
     * @dataProvider getAnyPassData
     */
    public function testAnyPass($expected, array $predicates, ...$arguments)
    {
        $main0 = P::anyPass($predicates);
        $this->assertSame($expected, $main0(...$arguments), 'anyPass produces correct results.');
        foreach ($this->getCurriedResults(P::anyPass(), $predicates) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'anyPass is curried correctly.');
        }
    }

    /**
     * @dataProvider getAppendData
     */
    public function testAppend($expected, $item, $collection)
    {
        $this->assertSame($expected, P::append($item, $collection), 'append produces correct results.');
        foreach ($this->getCurriedResults(P::append(), $item, $collection) as $result) {
            $this->assertSame($expected, $result, 'append is curried correctly.');
        }
    }

    /**
     * @dataProvider getApplyData
     */
    public function testApply($expected, callable $function, array $arguments)
    {
        $this->assertSame($expected, P::apply($function, $arguments), 'apply produces correct results.');
        foreach ($this->getCurriedResults(P::apply(), $function, $arguments) as $result) {
            $this->assertSame($expected, $result, 'apply is curried correctly.');
        }
    }

    /**
     * @dataProvider getAssocData
     */
    public function testAssoc($expected, $property, $value, $object)
    {
        $this->assertSame($expected, P::assoc($property, $value, $object), 'assoc produces correct results.');
        foreach ($this->getCurriedResults(P::assoc(), $property, $value, $object) as $result) {
            $this->assertSame($expected, $result, 'assoc is curried correctly.');
        }
    }

    /**
     * @dataProvider getAssocPathData
     */
    public function testAssocPath($expected, array $path, $value, $object)
    {
        $this->assertSame($expected, P::assocPath($path, $value, $object), 'assocPath produces correct results.');
        foreach ($this->getCurriedResults(P::assocPath(), $path, $value, $object) as $result) {
            $this->assertSame($expected, $result, 'assocPath is curried correctly.');
        }
    }

    /**
     * @dataProvider getBinaryData
     */
    public function testBinary($expected, callable $function, $a, $b)
    {
        $main0 = P::binary($function);
        $this->assertSame($expected, $main0($a, $b), 'binary produces correct results.');
        foreach ($this->getCurriedResults(P::binary(), $function) as $result) {
            $this->assertSame($expected, $result($a, $b), 'binary is curried correctly.');
        }
    }

    /**
     * @dataProvider getBothData
     */
    public function testBoth($expected, callable $a, callable $b, ...$arguments)
    {
        $main0 = P::both($a, $b);
        $this->assertSame($expected, $main0(...$arguments), 'both produces correct results.');
        foreach ($this->getCurriedResults(P::both(), $a, $b) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'both is curried correctly.');
        }
    }

    /**
     * @dataProvider getCastData
     */
    public function testCast($expected, $type, $value)
    {
        $this->assertSame($expected, P::cast($type, $value), 'cast produces correct results.');
        foreach ($this->getCurriedResults(P::cast(), $type, $value) as $result) {
            $this->assertSame($expected, $result, 'cast is curried correctly.');
        }
    }

    /**
     * @dataProvider getComparatorData
     */
    public function testComparator($expected, callable $predicate, $x, $y)
    {
        $main0 = P::comparator($predicate);
        $this->assertSame($expected, $main0($x, $y), 'comparator produces correct results.');
        foreach ($this->getCurriedResults(P::comparator(), $predicate) as $result) {
            $this->assertSame($expected, $result($x, $y), 'comparator is curried correctly.');
        }
    }

    /**
     * @dataProvider getComposeData
     */
    public function testCompose($expected, array $functions, ...$arguments)
    {
        $main0 = P::compose(...$functions);
        $this->assertSame($expected, $main0(...$arguments), 'compose produces correct results.');
    }

    /**
     * @dataProvider getConcatData
     */
    public function testConcat($expected, $a, $b)
    {
        $this->assertSame($expected, P::concat($a, $b), 'concat produces correct results.');
        foreach ($this->getCurriedResults(P::concat(), $a, $b) as $result) {
            $this->assertSame($expected, $result, 'concat is curried correctly.');
        }
    }

    /**
     * @dataProvider getContainsData
     */
    public function testContains($expected, $value, $collection)
    {
        $this->assertSame($expected, P::contains($value, $collection), 'contains produces correct results.');
        foreach ($this->getCurriedResults(P::contains(), $value, $collection) as $result) {
            $this->assertSame($expected, $result, 'contains is curried correctly.');
        }
    }

    /**
     * @dataProvider getCurryData
     */
    public function testCurry($expected, callable $function, ...$initialArguments)
    {
        $this->assertSame($expected, P::curry($function, ...$initialArguments), 'curry produces correct results.');
        foreach ($this->getCurriedResults(P::curry(), $function) as $result) {
            $this->assertSame($expected, $result(...$initialArguments), 'curry is curried correctly.');
        }
    }

    /**
     * @dataProvider getCurryNData
     */
    public function testCurryN($expected, $length, callable $function, ...$initialArguments)
    {
        $this->assertSame($expected, P::curryN($length, $function, ...$initialArguments), 'curryN produces correct results.');
        foreach ($this->getCurriedResults(P::curryN(), $length, $function) as $result) {
            $this->assertSame($expected, $result(...$initialArguments), 'curryN is curried correctly.');
        }
    }

    /**
     * @dataProvider getDecData
     */
    public function testDec($expected, $number)
    {
        $this->assertSame($expected, P::dec($number), 'dec produces correct results.');
        foreach ($this->getCurriedResults(P::dec(), $number) as $result) {
            $this->assertSame($expected, $result, 'dec is curried correctly.');
        }
    }

    /**
     * @dataProvider getDefaultToData
     */
    public function testDefaultTo($expected, $default, $value)
    {
        $this->assertSame($expected, P::defaultTo($default, $value), 'defaultTo produces correct results.');
        foreach ($this->getCurriedResults(P::defaultTo(), $default, $value) as $result) {
            $this->assertSame($expected, $result, 'defaultTo is curried correctly.');
        }
    }

    /**
     * @dataProvider getDivideData
     */
    public function testDivide($expected, $x, $y)
    {
        $this->assertSame($expected, P::divide($x, $y), 'divide produces correct results.');
        foreach ($this->getCurriedResults(P::divide(), $x, $y) as $result) {
            $this->assertSame($expected, $result, 'divide is curried correctly.');
        }
    }

    /**
     * @dataProvider getEachData
     */
    public function testEach($expected, callable $function, $collection)
    {
        $this->assertSame($expected, P::each($function, $collection), 'each produces correct results.');
        foreach ($this->getCurriedResults(P::each(), $function, $collection) as $result) {
            $this->assertSame($expected, $result, 'each is curried correctly.');
        }
    }

    /**
     * @dataProvider getEitherData
     */
    public function testEither($expected, callable $a, callable $b, ...$arguments)
    {
        $main0 = P::either($a, $b);
        $this->assertSame($expected, $main0(...$arguments), 'either produces correct results.');
        foreach ($this->getCurriedResults(P::either(), $a, $b) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'either is curried correctly.');
        }
    }

    /**
     * @dataProvider getEqData
     */
    public function testEq($expected, $x, $y)
    {
        $this->assertSame($expected, P::eq($x, $y), 'eq produces correct results.');
        foreach ($this->getCurriedResults(P::eq(), $x, $y) as $result) {
            $this->assertSame($expected, $result, 'eq is curried correctly.');
        }
    }

    /**
     * @dataProvider getEvolveData
     */
    public function testEvolve($expected, array $transformations, $object)
    {
        $this->assertSame($expected, P::evolve($transformations, $object), 'evolve produces correct results.');
        foreach ($this->getCurriedResults(P::evolve(), $transformations, $object) as $result) {
            $this->assertSame($expected, $result, 'evolve is curried correctly.');
        }
    }

    /**
     * @dataProvider getExplodeData
     */
    public function testExplode($expected, $delimiter, $string)
    {
        $this->assertSame($expected, P::explode($delimiter, $string), 'explode produces correct results.');
        foreach ($this->getCurriedResults(P::explode(), $delimiter, $string) as $result) {
            $this->assertSame($expected, $result, 'explode is curried correctly.');
        }
    }

    /**
     * @dataProvider getFalseData
     */
    public function testFalse($expected)
    {
        $main0 = P::false();
        $this->assertSame($expected, $main0(), 'false produces correct results.');
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilter($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, P::filter($predicate, $collection), 'filter produces correct results.');
        foreach ($this->getCurriedResults(P::filter(), $predicate, $collection) as $result) {
            $this->assertSame($expected, $result, 'filter is curried correctly.');
        }
    }

    /**
     * @dataProvider getFindData
     */
    public function testFind($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, P::find($predicate, $collection), 'find produces correct results.');
        foreach ($this->getCurriedResults(P::find(), $predicate, $collection) as $result) {
            $this->assertSame($expected, $result, 'find is curried correctly.');
        }
    }

    /**
     * @dataProvider getFindIndexData
     */
    public function testFindIndex($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, P::findIndex($predicate, $collection), 'findIndex produces correct results.');
        foreach ($this->getCurriedResults(P::findIndex(), $predicate, $collection) as $result) {
            $this->assertSame($expected, $result, 'findIndex is curried correctly.');
        }
    }

    /**
     * @dataProvider getFindLastData
     */
    public function testFindLast($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, P::findLast($predicate, $collection), 'findLast produces correct results.');
        foreach ($this->getCurriedResults(P::findLast(), $predicate, $collection) as $result) {
            $this->assertSame($expected, $result, 'findLast is curried correctly.');
        }
    }

    /**
     * @dataProvider getFindLastIndexData
     */
    public function testFindLastIndex($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, P::findLastIndex($predicate, $collection), 'findLastIndex produces correct results.');
        foreach ($this->getCurriedResults(P::findLastIndex(), $predicate, $collection) as $result) {
            $this->assertSame($expected, $result, 'findLastIndex is curried correctly.');
        }
    }

    /**
     * @dataProvider getFirstData
     */
    public function testFirst($expected, $collection)
    {
        $this->assertSame($expected, P::first($collection), 'first produces correct results.');
        foreach ($this->getCurriedResults(P::first(), $collection) as $result) {
            $this->assertSame($expected, $result, 'first is curried correctly.');
        }
    }

    /**
     * @dataProvider getFlatMapData
     */
    public function testFlatMap($expected, callable $function, array $list)
    {
        $this->assertSame($expected, P::flatMap($function, $list), 'flatMap produces correct results.');
        foreach ($this->getCurriedResults(P::flatMap(), $function, $list) as $result) {
            $this->assertSame($expected, $result, 'flatMap is curried correctly.');
        }
    }

    /**
     * @dataProvider getFlattenData
     */
    public function testFlatten($expected, array $list)
    {
        $this->assertSame($expected, P::flatten($list), 'flatten produces correct results.');
        foreach ($this->getCurriedResults(P::flatten(), $list) as $result) {
            $this->assertSame($expected, $result, 'flatten is curried correctly.');
        }
    }

    /**
     * @dataProvider getFlattenLevelData
     */
    public function testFlattenLevel($expected, array $list)
    {
        $this->assertSame($expected, P::flattenLevel($list), 'flattenLevel produces correct results.');
        foreach ($this->getCurriedResults(P::flattenLevel(), $list) as $result) {
            $this->assertSame($expected, $result, 'flattenLevel is curried correctly.');
        }
    }

    /**
     * @dataProvider getFlipData
     */
    public function testFlip($expected, callable $function, $a, $b, ...$arguments)
    {
        $main0 = P::flip($function);
        $this->assertSame($expected, $main0($a, $b, ...$arguments), 'flip produces correct results.');
        foreach ($this->getCurriedResults(P::flip(), $function) as $result) {
            $this->assertSame($expected, $result($a, $b, ...$arguments), 'flip is curried correctly.');
        }
    }

    /**
     * @dataProvider getFromPairsData
     */
    public function testFromPairs($expected, $list = null)
    {
        $this->assertSame($expected, P::fromPairs($list), 'fromPairs produces correct results.');
        foreach ($this->getCurriedResults(P::fromPairs(), $list) as $result) {
            $this->assertSame($expected, $result, 'fromPairs is curried correctly.');
        }
    }

    /**
     * @dataProvider getGroupByData
     */
    public function testGroupBy($expected, callable $function, $collection)
    {
        $this->assertSame($expected, P::groupBy($function, $collection), 'groupBy produces correct results.');
        foreach ($this->getCurriedResults(P::groupBy(), $function, $collection) as $result) {
            $this->assertSame($expected, $result, 'groupBy is curried correctly.');
        }
    }

    /**
     * @dataProvider getGtData
     */
    public function testGt($expected, $x, $y)
    {
        $this->assertSame($expected, P::gt($x, $y), 'gt produces correct results.');
        foreach ($this->getCurriedResults(P::gt(), $x, $y) as $result) {
            $this->assertSame($expected, $result, 'gt is curried correctly.');
        }
    }

    /**
     * @dataProvider getGteData
     */
    public function testGte($expected, $x, $y)
    {
        $this->assertSame($expected, P::gte($x, $y), 'gte produces correct results.');
        foreach ($this->getCurriedResults(P::gte(), $x, $y) as $result) {
            $this->assertSame($expected, $result, 'gte is curried correctly.');
        }
    }

    /**
     * @dataProvider getIdentityData
     */
    public function testIdentity($expected, $x)
    {
        $this->assertSame($expected, P::identity($x), 'identity produces correct results.');
        foreach ($this->getCurriedResults(P::identity(), $x) as $result) {
            $this->assertSame($expected, $result, 'identity is curried correctly.');
        }
    }

    /**
     * @dataProvider getIfElseData
     */
    public function testIfElse($expected, callable $condition, callable $onTrue, callable $onFalse, ...$arguments)
    {
        $main0 = P::ifElse($condition, $onTrue, $onFalse);
        $this->assertSame($expected, $main0(...$arguments), 'ifElse produces correct results.');
        foreach ($this->getCurriedResults(P::ifElse(), $condition, $onTrue, $onFalse) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'ifElse is curried correctly.');
        }
    }

    /**
     * @dataProvider getImplodeData
     */
    public function testImplode($expected, $glue, $strings)
    {
        $this->assertSame($expected, P::implode($glue, $strings), 'implode produces correct results.');
        foreach ($this->getCurriedResults(P::implode(), $glue, $strings) as $result) {
            $this->assertSame($expected, $result, 'implode is curried correctly.');
        }
    }

    /**
     * @dataProvider getIncData
     */
    public function testInc($expected, $number)
    {
        $this->assertSame($expected, P::inc($number), 'inc produces correct results.');
        foreach ($this->getCurriedResults(P::inc(), $number) as $result) {
            $this->assertSame($expected, $result, 'inc is curried correctly.');
        }
    }

    /**
     * @dataProvider getIndexOfData
     */
    public function testIndexOf($expected, $item, $collection)
    {
        $this->assertSame($expected, P::indexOf($item, $collection), 'indexOf produces correct results.');
        foreach ($this->getCurriedResults(P::indexOf(), $item, $collection) as $result) {
            $this->assertSame($expected, $result, 'indexOf is curried correctly.');
        }
    }

    /**
     * @dataProvider getInvokerData
     */
    public function testInvoker($expected, $arity, $method, array $initialArguments, ...$arguments)
    {
        $main0 = P::invoker($arity, $method, ...$initialArguments);
        $this->assertSame($expected, $main0(...$arguments), 'invoker produces correct results.');
        foreach ($this->getCurriedResults(P::invoker(), $arity, $method, ...$initialArguments) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'invoker is curried correctly.');
        }
    }

    /**
     * @dataProvider getIsEmptyData
     */
    public function testIsEmpty($expected, $collection)
    {
        $this->assertSame($expected, P::isEmpty($collection), 'isEmpty produces correct results.');
        foreach ($this->getCurriedResults(P::isEmpty(), $collection) as $result) {
            $this->assertSame($expected, $result, 'isEmpty is curried correctly.');
        }
    }

    /**
     * @dataProvider getIsInstanceData
     */
    public function testIsInstance($expected, $class, $object)
    {
        $this->assertSame($expected, P::isInstance($class, $object), 'isInstance produces correct results.');
        foreach ($this->getCurriedResults(P::isInstance(), $class, $object) as $result) {
            $this->assertSame($expected, $result, 'isInstance is curried correctly.');
        }
    }

    /**
     * @dataProvider getLastData
     */
    public function testLast($expected, $collection)
    {
        $this->assertSame($expected, P::last($collection), 'last produces correct results.');
        foreach ($this->getCurriedResults(P::last(), $collection) as $result) {
            $this->assertSame($expected, $result, 'last is curried correctly.');
        }
    }

    /**
     * @dataProvider getLtData
     */
    public function testLt($expected, $x, $y)
    {
        $this->assertSame($expected, P::lt($x, $y), 'lt produces correct results.');
        foreach ($this->getCurriedResults(P::lt(), $x, $y) as $result) {
            $this->assertSame($expected, $result, 'lt is curried correctly.');
        }
    }

    /**
     * @dataProvider getLteData
     */
    public function testLte($expected, $x, $y)
    {
        $this->assertSame($expected, P::lte($x, $y), 'lte produces correct results.');
        foreach ($this->getCurriedResults(P::lte(), $x, $y) as $result) {
            $this->assertSame($expected, $result, 'lte is curried correctly.');
        }
    }

    /**
     * @dataProvider getMapData
     */
    public function testMap($expected, callable $function, $collection)
    {
        $this->assertSame($expected, P::map($function, $collection), 'map produces correct results.');
        foreach ($this->getCurriedResults(P::map(), $function, $collection) as $result) {
            $this->assertSame($expected, $result, 'map is curried correctly.');
        }
    }

    /**
     * @dataProvider getMaxData
     */
    public function testMax($expected, $collection)
    {
        $this->assertSame($expected, P::max($collection), 'max produces correct results.');
        foreach ($this->getCurriedResults(P::max(), $collection) as $result) {
            $this->assertSame($expected, $result, 'max is curried correctly.');
        }
    }

    /**
     * @dataProvider getMaxByData
     */
    public function testMaxBy($expected, callable $getValue, $collection)
    {
        $this->assertSame($expected, P::maxBy($getValue, $collection), 'maxBy produces correct results.');
        foreach ($this->getCurriedResults(P::maxBy(), $getValue, $collection) as $result) {
            $this->assertSame($expected, $result, 'maxBy is curried correctly.');
        }
    }

    /**
     * @dataProvider getMergeData
     */
    public function testMerge($expected, array $a, array $b)
    {
        $this->assertSame($expected, P::merge($a, $b), 'merge produces correct results.');
        foreach ($this->getCurriedResults(P::merge(), $a, $b) as $result) {
            $this->assertSame($expected, $result, 'merge is curried correctly.');
        }
    }

    /**
     * @dataProvider getMinData
     */
    public function testMin($expected, $collection)
    {
        $this->assertSame($expected, P::min($collection), 'min produces correct results.');
        foreach ($this->getCurriedResults(P::min(), $collection) as $result) {
            $this->assertSame($expected, $result, 'min is curried correctly.');
        }
    }

    /**
     * @dataProvider getMinByData
     */
    public function testMinBy($expected, callable $getValue, $collection)
    {
        $this->assertSame($expected, P::minBy($getValue, $collection), 'minBy produces correct results.');
        foreach ($this->getCurriedResults(P::minBy(), $getValue, $collection) as $result) {
            $this->assertSame($expected, $result, 'minBy is curried correctly.');
        }
    }

    /**
     * @dataProvider getModuloData
     */
    public function testModulo($expected, $x, $y)
    {
        $this->assertSame($expected, P::modulo($x, $y), 'modulo produces correct results.');
        foreach ($this->getCurriedResults(P::modulo(), $x, $y) as $result) {
            $this->assertSame($expected, $result, 'modulo is curried correctly.');
        }
    }

    /**
     * @dataProvider getMultiplyData
     */
    public function testMultiply($expected, $x, $y)
    {
        $this->assertSame($expected, P::multiply($x, $y), 'multiply produces correct results.');
        foreach ($this->getCurriedResults(P::multiply(), $x, $y) as $result) {
            $this->assertSame($expected, $result, 'multiply is curried correctly.');
        }
    }

    /**
     * @dataProvider getNAryData
     */
    public function testNAry($expected, $arity, callable $function, ...$arguments)
    {
        $main0 = P::nAry($arity, $function);
        $this->assertSame($expected, $main0(...$arguments), 'nAry produces correct results.');
        foreach ($this->getCurriedResults(P::nAry(), $arity, $function) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'nAry is curried correctly.');
        }
    }

    /**
     * @dataProvider getNegateData
     */
    public function testNegate($expected, $x)
    {
        $this->assertSame($expected, P::negate($x), 'negate produces correct results.');
        foreach ($this->getCurriedResults(P::negate(), $x) as $result) {
            $this->assertSame($expected, $result, 'negate is curried correctly.');
        }
    }

    /**
     * @dataProvider getNoneData
     */
    public function testNone($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, P::none($predicate, $collection), 'none produces correct results.');
        foreach ($this->getCurriedResults(P::none(), $predicate, $collection) as $result) {
            $this->assertSame($expected, $result, 'none is curried correctly.');
        }
    }

    /**
     * @dataProvider getNotData
     */
    public function testNot($expected, callable $predicate, ...$arguments)
    {
        $main0 = P::not($predicate);
        $this->assertSame($expected, $main0(...$arguments), 'not produces correct results.');
        foreach ($this->getCurriedResults(P::not(), $predicate) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'not is curried correctly.');
        }
    }

    /**
     * @dataProvider getPartialData
     */
    public function testPartial($expected, callable $function, array $initialArguments, ...$arguments)
    {
        $main0 = P::partial($function, ...$initialArguments);
        $this->assertSame($expected, $main0(...$arguments), 'partial produces correct results.');
        foreach ($this->getCurriedResults(P::partial(), $function, ...$initialArguments) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'partial is curried correctly.');
        }
    }

    /**
     * @dataProvider getPartialNData
     */
    public function testPartialN($expected, $arity, callable $function, array $initialArguments, ...$arguments)
    {
        $main0 = P::partialN($arity, $function, ...$initialArguments);
        $this->assertSame($expected, $main0(...$arguments), 'partialN produces correct results.');
        foreach ($this->getCurriedResults(P::partialN(), $arity, $function, ...$initialArguments) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'partialN is curried correctly.');
        }
    }

    /**
     * @dataProvider getPartitionData
     */
    public function testPartition($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, P::partition($predicate, $collection), 'partition produces correct results.');
        foreach ($this->getCurriedResults(P::partition(), $predicate, $collection) as $result) {
            $this->assertSame($expected, $result, 'partition is curried correctly.');
        }
    }

    /**
     * @dataProvider getPathData
     */
    public function testPath($expected, array $path, $object)
    {
        $this->assertSame($expected, P::path($path, $object), 'path produces correct results.');
        foreach ($this->getCurriedResults(P::path(), $path, $object) as $result) {
            $this->assertSame($expected, $result, 'path is curried correctly.');
        }
    }

    /**
     * @dataProvider getPathEqData
     */
    public function testPathEq($expected, array $path, $value, $object)
    {
        $this->assertSame($expected, P::pathEq($path, $value, $object), 'pathEq produces correct results.');
        foreach ($this->getCurriedResults(P::pathEq(), $path, $value, $object) as $result) {
            $this->assertSame($expected, $result, 'pathEq is curried correctly.');
        }
    }

    /**
     * @dataProvider getPickData
     */
    public function testPick($expected, array $names, array $item)
    {
        $this->assertSame($expected, P::pick($names, $item), 'pick produces correct results.');
        foreach ($this->getCurriedResults(P::pick(), $names, $item) as $result) {
            $this->assertSame($expected, $result, 'pick is curried correctly.');
        }
    }

    /**
     * @dataProvider getPickAllData
     */
    public function testPickAll($expected, array $names, array $item)
    {
        $this->assertSame($expected, P::pickAll($names, $item), 'pickAll produces correct results.');
        foreach ($this->getCurriedResults(P::pickAll(), $names, $item) as $result) {
            $this->assertSame($expected, $result, 'pickAll is curried correctly.');
        }
    }

    /**
     * @dataProvider getPipeData
     */
    public function testPipe($expected, array $functions, ...$arguments)
    {
        $main0 = P::pipe(...$functions);
        $this->assertSame($expected, $main0(...$arguments), 'pipe produces correct results.');
    }

    /**
     * @dataProvider getPluckData
     */
    public function testPluck($expected, $name, $collection)
    {
        $this->assertSame($expected, P::pluck($name, $collection), 'pluck produces correct results.');
        foreach ($this->getCurriedResults(P::pluck(), $name, $collection) as $result) {
            $this->assertSame($expected, $result, 'pluck is curried correctly.');
        }
    }

    /**
     * @dataProvider getPrependData
     */
    public function testPrepend($expected, $item, $collection)
    {
        $this->assertSame($expected, P::prepend($item, $collection), 'prepend produces correct results.');
        foreach ($this->getCurriedResults(P::prepend(), $item, $collection) as $result) {
            $this->assertSame($expected, $result, 'prepend is curried correctly.');
        }
    }

    /**
     * @dataProvider getProductData
     */
    public function testProduct($expected, $values)
    {
        $this->assertSame($expected, P::product($values), 'product produces correct results.');
        foreach ($this->getCurriedResults(P::product(), $values) as $result) {
            $this->assertSame($expected, $result, 'product is curried correctly.');
        }
    }

    /**
     * @dataProvider getPropData
     */
    public function testProp($expected, $name, $object)
    {
        $this->assertSame($expected, P::prop($name, $object), 'prop produces correct results.');
        foreach ($this->getCurriedResults(P::prop(), $name, $object) as $result) {
            $this->assertSame($expected, $result, 'prop is curried correctly.');
        }
    }

    /**
     * @dataProvider getPropEqData
     */
    public function testPropEq($expected, $name, $value, $object)
    {
        $this->assertSame($expected, P::propEq($name, $value, $object), 'propEq produces correct results.');
        foreach ($this->getCurriedResults(P::propEq(), $name, $value, $object) as $result) {
            $this->assertSame($expected, $result, 'propEq is curried correctly.');
        }
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduce($expected, callable $function, $initial, $collection)
    {
        $this->assertSame($expected, P::reduce($function, $initial, $collection), 'reduce produces correct results.');
        foreach ($this->getCurriedResults(P::reduce(), $function, $initial, $collection) as $result) {
            $this->assertSame($expected, $result, 'reduce is curried correctly.');
        }
    }

    /**
     * @dataProvider getReduceRightData
     */
    public function testReduceRight($expected, callable $function, $initial, $collection)
    {
        $this->assertSame($expected, P::reduceRight($function, $initial, $collection), 'reduceRight produces correct results.');
        foreach ($this->getCurriedResults(P::reduceRight(), $function, $initial, $collection) as $result) {
            $this->assertSame($expected, $result, 'reduceRight is curried correctly.');
        }
    }

    /**
     * @dataProvider getRejectData
     */
    public function testReject($expected, callable $predicate, $collection)
    {
        $this->assertSame($expected, P::reject($predicate, $collection), 'reject produces correct results.');
        foreach ($this->getCurriedResults(P::reject(), $predicate, $collection) as $result) {
            $this->assertSame($expected, $result, 'reject is curried correctly.');
        }
    }

    /**
     * @dataProvider getReverseData
     */
    public function testReverse($expected, $collection)
    {
        $this->assertSame($expected, P::reverse($collection), 'reverse produces correct results.');
        foreach ($this->getCurriedResults(P::reverse(), $collection) as $result) {
            $this->assertSame($expected, $result, 'reverse is curried correctly.');
        }
    }

    /**
     * @dataProvider getSliceData
     */
    public function testSlice($expected, $start, $end, $collection)
    {
        $this->assertSame($expected, P::slice($start, $end, $collection), 'slice produces correct results.');
        foreach ($this->getCurriedResults(P::slice(), $start, $end, $collection) as $result) {
            $this->assertSame($expected, $result, 'slice is curried correctly.');
        }
    }

    /**
     * @dataProvider getSortData
     */
    public function testSort($expected, callable $comparator, $collection)
    {
        $this->assertSame($expected, P::sort($comparator, $collection), 'sort produces correct results.');
        foreach ($this->getCurriedResults(P::sort(), $comparator, $collection) as $result) {
            $this->assertSame($expected, $result, 'sort is curried correctly.');
        }
    }

    /**
     * @dataProvider getSortByData
     */
    public function testSortBy($expected, callable $function, $collection)
    {
        $this->assertSame($expected, P::sortBy($function, $collection), 'sortBy produces correct results.');
        foreach ($this->getCurriedResults(P::sortBy(), $function, $collection) as $result) {
            $this->assertSame($expected, $result, 'sortBy is curried correctly.');
        }
    }

    /**
     * @dataProvider getStringIndexOfData
     */
    public function testStringIndexOf($expected, $substring, $string)
    {
        $this->assertSame($expected, P::stringIndexOf($substring, $string), 'stringIndexOf produces correct results.');
        foreach ($this->getCurriedResults(P::stringIndexOf(), $substring, $string) as $result) {
            $this->assertSame($expected, $result, 'stringIndexOf is curried correctly.');
        }
    }

    /**
     * @dataProvider getStringLastIndexOfData
     */
    public function testStringLastIndexOf($expected, $substring, $string)
    {
        $this->assertSame($expected, P::stringLastIndexOf($substring, $string), 'stringLastIndexOf produces correct results.');
        foreach ($this->getCurriedResults(P::stringLastIndexOf(), $substring, $string) as $result) {
            $this->assertSame($expected, $result, 'stringLastIndexOf is curried correctly.');
        }
    }

    /**
     * @dataProvider getSubstringData
     */
    public function testSubstring($expected, $start, $end, $string)
    {
        $this->assertSame($expected, P::substring($start, $end, $string), 'substring produces correct results.');
        foreach ($this->getCurriedResults(P::substring(), $start, $end, $string) as $result) {
            $this->assertSame($expected, $result, 'substring is curried correctly.');
        }
    }

    /**
     * @dataProvider getSubstringFromData
     */
    public function testSubstringFrom($expected, $start, $string)
    {
        $this->assertSame($expected, P::substringFrom($start, $string), 'substringFrom produces correct results.');
        foreach ($this->getCurriedResults(P::substringFrom(), $start, $string) as $result) {
            $this->assertSame($expected, $result, 'substringFrom is curried correctly.');
        }
    }

    /**
     * @dataProvider getSubstringToData
     */
    public function testSubstringTo($expected, $end, $string)
    {
        $this->assertSame($expected, P::substringTo($end, $string), 'substringTo produces correct results.');
        foreach ($this->getCurriedResults(P::substringTo(), $end, $string) as $result) {
            $this->assertSame($expected, $result, 'substringTo is curried correctly.');
        }
    }

    /**
     * @dataProvider getSubtractData
     */
    public function testSubtract($expected, $x, $y)
    {
        $this->assertSame($expected, P::subtract($x, $y), 'subtract produces correct results.');
        foreach ($this->getCurriedResults(P::subtract(), $x, $y) as $result) {
            $this->assertSame($expected, $result, 'subtract is curried correctly.');
        }
    }

    /**
     * @dataProvider getSumData
     */
    public function testSum($expected, $values)
    {
        $this->assertSame($expected, P::sum($values), 'sum produces correct results.');
        foreach ($this->getCurriedResults(P::sum(), $values) as $result) {
            $this->assertSame($expected, $result, 'sum is curried correctly.');
        }
    }

    /**
     * @dataProvider getTailData
     */
    public function testTail($expected, $collection)
    {
        $this->assertSame($expected, P::tail($collection), 'tail produces correct results.');
        foreach ($this->getCurriedResults(P::tail(), $collection) as $result) {
            $this->assertSame($expected, $result, 'tail is curried correctly.');
        }
    }

    /**
     * @dataProvider getTapData
     */
    public function testTap($expected, callable $function, $object)
    {
        $this->assertSame($expected, P::tap($function, $object), 'tap produces correct results.');
        foreach ($this->getCurriedResults(P::tap(), $function, $object) as $result) {
            $this->assertSame($expected, $result, 'tap is curried correctly.');
        }
    }

    /**
     * @dataProvider getTimesData
     */
    public function testTimes($expected, callable $function, $count)
    {
        $this->assertSame($expected, P::times($function, $count), 'times produces correct results.');
        foreach ($this->getCurriedResults(P::times(), $function, $count) as $result) {
            $this->assertSame($expected, $result, 'times is curried correctly.');
        }
    }

    /**
     * @dataProvider getToPairsData
     */
    public function testToPairs($expected, $map = null)
    {
        $this->assertSame($expected, P::toPairs($map), 'toPairs produces correct results.');
        foreach ($this->getCurriedResults(P::toPairs(), $map) as $result) {
            $this->assertSame($expected, $result, 'toPairs is curried correctly.');
        }
    }

    /**
     * @dataProvider getTrueData
     */
    public function testTrue($expected)
    {
        $main0 = P::true();
        $this->assertSame($expected, $main0(), 'true produces correct results.');
    }

    /**
     * @dataProvider getUnaryData
     */
    public function testUnary($expected, callable $function, $a)
    {
        $main0 = P::unary($function);
        $this->assertSame($expected, $main0($a), 'unary produces correct results.');
        foreach ($this->getCurriedResults(P::unary(), $function) as $result) {
            $this->assertSame($expected, $result($a), 'unary is curried correctly.');
        }
    }

    /**
     * @dataProvider getUnapplyData
     */
    public function testUnapply($expected, callable $function, ...$arguments)
    {
        $this->assertSame($expected, P::unapply($function, ...$arguments), 'unapply produces correct results.');
        foreach ($this->getCurriedResults(P::unapply(), $function) as $result) {
            $this->assertSame($expected, $result(...$arguments), 'unapply is curried correctly.');
        }
    }

    /**
     * @dataProvider getWhereData
     */
    public function testWhere($expected, array $specification, $object)
    {
        $this->assertSame($expected, P::where($specification, $object), 'where produces correct results.');
        foreach ($this->getCurriedResults(P::where(), $specification, $object) as $result) {
            $this->assertSame($expected, $result, 'where is curried correctly.');
        }
    }

    /**
     * @dataProvider getZipData
     */
    public function testZip($expected, array $a, array $b)
    {
        $this->assertSame($expected, P::zip($a, $b), 'zip produces correct results.');
        foreach ($this->getCurriedResults(P::zip(), $a, $b) as $result) {
            $this->assertSame($expected, $result, 'zip is curried correctly.');
        }
    }

    /**
     * @dataProvider getZipWithData
     */
    public function testZipWith($expected, callable $function, array $a, array $b)
    {
        $this->assertSame($expected, P::zipWith($function, $a, $b), 'zipWith produces correct results.');
        foreach ($this->getCurriedResults(P::zipWith(), $function, $a, $b) as $result) {
            $this->assertSame($expected, $result, 'zipWith is curried correctly.');
        }
    }
}
