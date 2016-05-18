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
use Phamda\Tests\Fixtures\ArrayCollection;
use Phamda\Tests\Fixtures\ArrayContainer;

/**
 * Test cases for basic functionality with collection objects.
 *
 * This class is automatically generated using the `\Phamda\Builder\InnerFunctions` class.
 *
 * For details about the code generation, please see: https://github.com/mpajunen/phamda-codegen
 */
class CollectionTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait, CollectionTestTrait;

    /**
     * @dataProvider getAllData
     */
    public function testAll($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::all($predicate, $_collection);
        $this->assertSame($expected, $result, 'all works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'all does not modify original collection values.');
    }

    /**
     * @dataProvider getAllData
     */
    public function testAllSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::all($predicate, $_collection);
        $this->assertSame($expected, $result, 'all works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'all does not modify original collection values.');
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAny($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::any($predicate, $_collection);
        $this->assertSame($expected, $result, 'any works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'any does not modify original collection values.');
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAnySimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::any($predicate, $_collection);
        $this->assertSame($expected, $result, 'any works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'any does not modify original collection values.');
    }

    /**
     * @dataProvider getAppendData
     */
    public function testAppend($expected, $item, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::append($item, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'append works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'append does not modify original collection values.');
    }

    /**
     * @dataProvider getAppendData
     */
    public function testAppendSimple($expected, $item, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::append($item, $_collection);
        $this->assertSame($expected, $result, 'append works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'append does not modify original collection values.');
    }

    /**
     * @dataProvider getContainsData
     */
    public function testContains($expected, $value, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::contains($value, $_collection);
        $this->assertSame($expected, $result, 'contains works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'contains does not modify original collection values.');
    }

    /**
     * @dataProvider getContainsData
     */
    public function testContainsSimple($expected, $value, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::contains($value, $_collection);
        $this->assertSame($expected, $result, 'contains works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'contains does not modify original collection values.');
    }

    /**
     * @dataProvider getEachData
     */
    public function testEach($expected, callable $function, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::each($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'each works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'each does not modify original collection values.');
    }

    /**
     * @dataProvider getEachData
     */
    public function testEachSimple($expected, callable $function, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::each($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'each works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'each does not modify original collection values.');
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilter($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::filter($predicate, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'filter works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'filter does not modify original collection values.');
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilterSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::filter($predicate, $_collection);
        $this->assertSame($expected, $result, 'filter works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'filter does not modify original collection values.');
    }

    /**
     * @dataProvider getFindData
     */
    public function testFind($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::find($predicate, $_collection);
        $this->assertSame($expected, $result, 'find works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'find does not modify original collection values.');
    }

    /**
     * @dataProvider getFindData
     */
    public function testFindSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::find($predicate, $_collection);
        $this->assertSame($expected, $result, 'find works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'find does not modify original collection values.');
    }

    /**
     * @dataProvider getFindIndexData
     */
    public function testFindIndex($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::findIndex($predicate, $_collection);
        $this->assertSame($expected, $result, 'findIndex works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findIndex does not modify original collection values.');
    }

    /**
     * @dataProvider getFindIndexData
     */
    public function testFindIndexSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::findIndex($predicate, $_collection);
        $this->assertSame($expected, $result, 'findIndex works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findIndex does not modify original collection values.');
    }

    /**
     * @dataProvider getFindLastData
     */
    public function testFindLast($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::findLast($predicate, $_collection);
        $this->assertSame($expected, $result, 'findLast works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findLast does not modify original collection values.');
    }

    /**
     * @dataProvider getFindLastData
     */
    public function testFindLastSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::findLast($predicate, $_collection);
        $this->assertSame($expected, $result, 'findLast works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findLast does not modify original collection values.');
    }

    /**
     * @dataProvider getFindLastIndexData
     */
    public function testFindLastIndex($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::findLastIndex($predicate, $_collection);
        $this->assertSame($expected, $result, 'findLastIndex works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findLastIndex does not modify original collection values.');
    }

    /**
     * @dataProvider getFindLastIndexData
     */
    public function testFindLastIndexSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::findLastIndex($predicate, $_collection);
        $this->assertSame($expected, $result, 'findLastIndex works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findLastIndex does not modify original collection values.');
    }

    /**
     * @dataProvider getFirstData
     */
    public function testFirst($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::first($_collection);
        $this->assertSame($expected, $result, 'first works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'first does not modify original collection values.');
    }

    /**
     * @dataProvider getFirstData
     */
    public function testFirstSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::first($_collection);
        $this->assertSame($expected, $result, 'first works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'first does not modify original collection values.');
    }

    /**
     * @dataProvider getFromPairsData
     */
    public function testFromPairs($expected, $list = null)
    {
        $_list  = new ArrayCollection($list);
        $result = P::fromPairs($_list);
        $this->assertSame($expected, $this->getCollectionArray($result), 'fromPairs works for collection objects.');
        $this->assertSame($list, $_list->toArray(), 'fromPairs does not modify original collection values.');
    }

    /**
     * @dataProvider getFromPairsData
     */
    public function testFromPairsSimple($expected, $list = null)
    {
        $_list  = new ArrayContainer($list);
        $result = P::fromPairs($_list);
        $this->assertSame($expected, $result, 'fromPairs works for simple collection objects.');
        $this->assertSame($list, $_list->toArray(), 'fromPairs does not modify original collection values.');
    }

    /**
     * @dataProvider getGroupByData
     */
    public function testGroupBy($expected, callable $function, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::groupBy($function, $_collection);
        $this->assertSame($expected, $this->getCollectionGroupArray($result), 'groupBy works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'groupBy does not modify original collection values.');
    }

    /**
     * @dataProvider getGroupByData
     */
    public function testGroupBySimple($expected, callable $function, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::groupBy($function, $_collection);
        $this->assertSame($expected, $result, 'groupBy works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'groupBy does not modify original collection values.');
    }

    /**
     * @dataProvider getIndexOfData
     */
    public function testIndexOf($expected, $item, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::indexOf($item, $_collection);
        $this->assertSame($expected, $result, 'indexOf works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'indexOf does not modify original collection values.');
    }

    /**
     * @dataProvider getIndexOfData
     */
    public function testIndexOfSimple($expected, $item, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::indexOf($item, $_collection);
        $this->assertSame($expected, $result, 'indexOf works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'indexOf does not modify original collection values.');
    }

    /**
     * @dataProvider getIsEmptyData
     */
    public function testIsEmpty($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::isEmpty($_collection);
        $this->assertSame($expected, $result, 'isEmpty works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'isEmpty does not modify original collection values.');
    }

    /**
     * @dataProvider getIsEmptyData
     */
    public function testIsEmptySimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::isEmpty($_collection);
        $this->assertSame($expected, $result, 'isEmpty works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'isEmpty does not modify original collection values.');
    }

    /**
     * @dataProvider getLastData
     */
    public function testLast($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::last($_collection);
        $this->assertSame($expected, $result, 'last works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'last does not modify original collection values.');
    }

    /**
     * @dataProvider getLastData
     */
    public function testLastSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::last($_collection);
        $this->assertSame($expected, $result, 'last works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'last does not modify original collection values.');
    }

    /**
     * @dataProvider getMapData
     */
    public function testMap($expected, callable $function, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::map($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'map works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'map does not modify original collection values.');
    }

    /**
     * @dataProvider getMapData
     */
    public function testMapSimple($expected, callable $function, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::map($function, $_collection);
        $this->assertSame($expected, $result, 'map works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'map does not modify original collection values.');
    }

    /**
     * @dataProvider getMaxData
     */
    public function testMax($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::max($_collection);
        $this->assertSame($expected, $result, 'max works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'max does not modify original collection values.');
    }

    /**
     * @dataProvider getMaxData
     */
    public function testMaxSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::max($_collection);
        $this->assertSame($expected, $result, 'max works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'max does not modify original collection values.');
    }

    /**
     * @dataProvider getMaxByData
     */
    public function testMaxBy($expected, callable $getValue, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::maxBy($getValue, $_collection);
        $this->assertSame($expected, $result, 'maxBy works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'maxBy does not modify original collection values.');
    }

    /**
     * @dataProvider getMaxByData
     */
    public function testMaxBySimple($expected, callable $getValue, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::maxBy($getValue, $_collection);
        $this->assertSame($expected, $result, 'maxBy works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'maxBy does not modify original collection values.');
    }

    /**
     * @dataProvider getMinData
     */
    public function testMin($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::min($_collection);
        $this->assertSame($expected, $result, 'min works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'min does not modify original collection values.');
    }

    /**
     * @dataProvider getMinData
     */
    public function testMinSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::min($_collection);
        $this->assertSame($expected, $result, 'min works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'min does not modify original collection values.');
    }

    /**
     * @dataProvider getMinByData
     */
    public function testMinBy($expected, callable $getValue, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::minBy($getValue, $_collection);
        $this->assertSame($expected, $result, 'minBy works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'minBy does not modify original collection values.');
    }

    /**
     * @dataProvider getMinByData
     */
    public function testMinBySimple($expected, callable $getValue, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::minBy($getValue, $_collection);
        $this->assertSame($expected, $result, 'minBy works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'minBy does not modify original collection values.');
    }

    /**
     * @dataProvider getNoneData
     */
    public function testNone($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::none($predicate, $_collection);
        $this->assertSame($expected, $result, 'none works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'none does not modify original collection values.');
    }

    /**
     * @dataProvider getNoneData
     */
    public function testNoneSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::none($predicate, $_collection);
        $this->assertSame($expected, $result, 'none works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'none does not modify original collection values.');
    }

    /**
     * @dataProvider getPartitionData
     */
    public function testPartition($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::partition($predicate, $_collection);
        $this->assertSame($expected, $this->getCollectionGroupArray($result), 'partition works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'partition does not modify original collection values.');
    }

    /**
     * @dataProvider getPartitionData
     */
    public function testPartitionSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::partition($predicate, $_collection);
        $this->assertSame($expected, $result, 'partition works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'partition does not modify original collection values.');
    }

    /**
     * @dataProvider getPluckData
     */
    public function testPluck($expected, $name, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::pluck($name, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'pluck works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'pluck does not modify original collection values.');
    }

    /**
     * @dataProvider getPluckData
     */
    public function testPluckSimple($expected, $name, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::pluck($name, $_collection);
        $this->assertSame($expected, $result, 'pluck works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'pluck does not modify original collection values.');
    }

    /**
     * @dataProvider getPrependData
     */
    public function testPrepend($expected, $item, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::prepend($item, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'prepend works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'prepend does not modify original collection values.');
    }

    /**
     * @dataProvider getPrependData
     */
    public function testPrependSimple($expected, $item, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::prepend($item, $_collection);
        $this->assertSame($expected, $result, 'prepend works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'prepend does not modify original collection values.');
    }

    /**
     * @dataProvider getProductData
     */
    public function testProduct($expected, $values)
    {
        $_values = new ArrayCollection($values);
        $result  = P::product($_values);
        $this->assertSame($expected, $result, 'product works for collection objects.');
        $this->assertSame($values, $_values->toArray(), 'product does not modify original collection values.');
    }

    /**
     * @dataProvider getProductData
     */
    public function testProductSimple($expected, $values)
    {
        $_values = new ArrayContainer($values);
        $result  = P::product($_values);
        $this->assertSame($expected, $result, 'product works for simple collection objects.');
        $this->assertSame($values, $_values->toArray(), 'product does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduce($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::reduce($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduce works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduce does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduceSimple($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::reduce($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduce works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduce does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceRightData
     */
    public function testReduceRight($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::reduceRight($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduceRight works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduceRight does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceRightData
     */
    public function testReduceRightSimple($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::reduceRight($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduceRight works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduceRight does not modify original collection values.');
    }

    /**
     * @dataProvider getRejectData
     */
    public function testReject($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::reject($predicate, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'reject works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reject does not modify original collection values.');
    }

    /**
     * @dataProvider getRejectData
     */
    public function testRejectSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::reject($predicate, $_collection);
        $this->assertSame($expected, $result, 'reject works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reject does not modify original collection values.');
    }

    /**
     * @dataProvider getReverseData
     */
    public function testReverse($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::reverse($_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'reverse works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reverse does not modify original collection values.');
    }

    /**
     * @dataProvider getReverseData
     */
    public function testReverseSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::reverse($_collection);
        $this->assertSame($expected, $result, 'reverse works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reverse does not modify original collection values.');
    }

    /**
     * @dataProvider getSliceData
     */
    public function testSlice($expected, $start, $end, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::slice($start, $end, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'slice works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'slice does not modify original collection values.');
    }

    /**
     * @dataProvider getSliceData
     */
    public function testSliceSimple($expected, $start, $end, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::slice($start, $end, $_collection);
        $this->assertSame($expected, $result, 'slice works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'slice does not modify original collection values.');
    }

    /**
     * @dataProvider getSortData
     */
    public function testSort($expected, callable $comparator, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::sort($comparator, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'sort works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'sort does not modify original collection values.');
    }

    /**
     * @dataProvider getSortData
     */
    public function testSortSimple($expected, callable $comparator, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::sort($comparator, $_collection);
        $this->assertSame($expected, $result, 'sort works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'sort does not modify original collection values.');
    }

    /**
     * @dataProvider getSortByData
     */
    public function testSortBy($expected, callable $function, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::sortBy($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'sortBy works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'sortBy does not modify original collection values.');
    }

    /**
     * @dataProvider getSortByData
     */
    public function testSortBySimple($expected, callable $function, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::sortBy($function, $_collection);
        $this->assertSame($expected, $result, 'sortBy works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'sortBy does not modify original collection values.');
    }

    /**
     * @dataProvider getSumData
     */
    public function testSum($expected, $values)
    {
        $_values = new ArrayCollection($values);
        $result  = P::sum($_values);
        $this->assertSame($expected, $result, 'sum works for collection objects.');
        $this->assertSame($values, $_values->toArray(), 'sum does not modify original collection values.');
    }

    /**
     * @dataProvider getSumData
     */
    public function testSumSimple($expected, $values)
    {
        $_values = new ArrayContainer($values);
        $result  = P::sum($_values);
        $this->assertSame($expected, $result, 'sum works for simple collection objects.');
        $this->assertSame($values, $_values->toArray(), 'sum does not modify original collection values.');
    }

    /**
     * @dataProvider getTailData
     */
    public function testTail($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = P::tail($_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'tail works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'tail does not modify original collection values.');
    }

    /**
     * @dataProvider getTailData
     */
    public function testTailSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = P::tail($_collection);
        $this->assertSame($expected, $result, 'tail works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'tail does not modify original collection values.');
    }

    /**
     * @dataProvider getToPairsData
     */
    public function testToPairs($expected, $map = null)
    {
        $_map   = new ArrayCollection($map);
        $result = P::toPairs($_map);
        $this->assertSame($expected, $this->getCollectionArray($result), 'toPairs works for collection objects.');
        $this->assertSame($map, $_map->toArray(), 'toPairs does not modify original collection values.');
    }

    /**
     * @dataProvider getToPairsData
     */
    public function testToPairsSimple($expected, $map = null)
    {
        $_map   = new ArrayContainer($map);
        $result = P::toPairs($_map);
        $this->assertSame($expected, $result, 'toPairs works for simple collection objects.');
        $this->assertSame($map, $_map->toArray(), 'toPairs does not modify original collection values.');
    }
}
