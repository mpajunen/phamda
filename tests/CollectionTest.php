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
        $result      = Phamda::all($predicate, $_collection);
        $this->assertSame($expected, $result, 'all works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'all does not modify original collection values.');
    }

    /**
     * @dataProvider getAllData
     */
    public function testAllSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::all($predicate, $_collection);
        $this->assertSame($expected, $result, 'all works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'all does not modify original collection values.');
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAny($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::any($predicate, $_collection);
        $this->assertSame($expected, $result, 'any works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'any does not modify original collection values.');
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAnySimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::any($predicate, $_collection);
        $this->assertSame($expected, $result, 'any works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'any does not modify original collection values.');
    }

    /**
     * @dataProvider getAppendData
     */
    public function testAppend($expected, $item, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::append($item, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'append works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'append does not modify original collection values.');
    }

    /**
     * @dataProvider getAppendData
     */
    public function testAppendSimple($expected, $item, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::append($item, $_collection);
        $this->assertSame($expected, $result, 'append works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'append does not modify original collection values.');
    }

    /**
     * @dataProvider getContainsData
     */
    public function testContains($expected, $value, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::contains($value, $_collection);
        $this->assertSame($expected, $result, 'contains works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'contains does not modify original collection values.');
    }

    /**
     * @dataProvider getContainsData
     */
    public function testContainsSimple($expected, $value, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::contains($value, $_collection);
        $this->assertSame($expected, $result, 'contains works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'contains does not modify original collection values.');
    }

    /**
     * @dataProvider getEachData
     */
    public function testEach($expected, callable $function, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::each($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'each works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'each does not modify original collection values.');
    }

    /**
     * @dataProvider getEachData
     */
    public function testEachSimple($expected, callable $function, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::each($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'each works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'each does not modify original collection values.');
    }

    /**
     * @dataProvider getEachIndexedData
     */
    public function testEachIndexed($expected, callable $function, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::eachIndexed($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'eachIndexed works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'eachIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getEachIndexedData
     */
    public function testEachIndexedSimple($expected, callable $function, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::eachIndexed($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'eachIndexed works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'eachIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilter($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::filter($predicate, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'filter works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'filter does not modify original collection values.');
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilterSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::filter($predicate, $_collection);
        $this->assertSame($expected, $result, 'filter works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'filter does not modify original collection values.');
    }

    /**
     * @dataProvider getFilterIndexedData
     */
    public function testFilterIndexed($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::filterIndexed($predicate, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'filterIndexed works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'filterIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getFilterIndexedData
     */
    public function testFilterIndexedSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::filterIndexed($predicate, $_collection);
        $this->assertSame($expected, $result, 'filterIndexed works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'filterIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getFindData
     */
    public function testFind($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::find($predicate, $_collection);
        $this->assertSame($expected, $result, 'find works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'find does not modify original collection values.');
    }

    /**
     * @dataProvider getFindData
     */
    public function testFindSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::find($predicate, $_collection);
        $this->assertSame($expected, $result, 'find works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'find does not modify original collection values.');
    }

    /**
     * @dataProvider getFindIndexData
     */
    public function testFindIndex($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::findIndex($predicate, $_collection);
        $this->assertSame($expected, $result, 'findIndex works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findIndex does not modify original collection values.');
    }

    /**
     * @dataProvider getFindIndexData
     */
    public function testFindIndexSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::findIndex($predicate, $_collection);
        $this->assertSame($expected, $result, 'findIndex works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findIndex does not modify original collection values.');
    }

    /**
     * @dataProvider getFindLastData
     */
    public function testFindLast($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::findLast($predicate, $_collection);
        $this->assertSame($expected, $result, 'findLast works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findLast does not modify original collection values.');
    }

    /**
     * @dataProvider getFindLastData
     */
    public function testFindLastSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::findLast($predicate, $_collection);
        $this->assertSame($expected, $result, 'findLast works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findLast does not modify original collection values.');
    }

    /**
     * @dataProvider getFindLastIndexData
     */
    public function testFindLastIndex($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::findLastIndex($predicate, $_collection);
        $this->assertSame($expected, $result, 'findLastIndex works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findLastIndex does not modify original collection values.');
    }

    /**
     * @dataProvider getFindLastIndexData
     */
    public function testFindLastIndexSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::findLastIndex($predicate, $_collection);
        $this->assertSame($expected, $result, 'findLastIndex works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'findLastIndex does not modify original collection values.');
    }

    /**
     * @dataProvider getFirstData
     */
    public function testFirst($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::first($_collection);
        $this->assertSame($expected, $result, 'first works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'first does not modify original collection values.');
    }

    /**
     * @dataProvider getFirstData
     */
    public function testFirstSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::first($_collection);
        $this->assertSame($expected, $result, 'first works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'first does not modify original collection values.');
    }

    /**
     * @dataProvider getGroupByData
     */
    public function testGroupBy($expected, callable $function, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::groupBy($function, $_collection);
        $this->assertSame($expected, $this->getCollectionGroupArray($result), 'groupBy works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'groupBy does not modify original collection values.');
    }

    /**
     * @dataProvider getGroupByData
     */
    public function testGroupBySimple($expected, callable $function, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::groupBy($function, $_collection);
        $this->assertSame($expected, $result, 'groupBy works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'groupBy does not modify original collection values.');
    }

    /**
     * @dataProvider getIndexOfData
     */
    public function testIndexOf($expected, $item, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::indexOf($item, $_collection);
        $this->assertSame($expected, $result, 'indexOf works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'indexOf does not modify original collection values.');
    }

    /**
     * @dataProvider getIndexOfData
     */
    public function testIndexOfSimple($expected, $item, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::indexOf($item, $_collection);
        $this->assertSame($expected, $result, 'indexOf works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'indexOf does not modify original collection values.');
    }

    /**
     * @dataProvider getIsEmptyData
     */
    public function testIsEmpty($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::isEmpty($_collection);
        $this->assertSame($expected, $result, 'isEmpty works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'isEmpty does not modify original collection values.');
    }

    /**
     * @dataProvider getIsEmptyData
     */
    public function testIsEmptySimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::isEmpty($_collection);
        $this->assertSame($expected, $result, 'isEmpty works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'isEmpty does not modify original collection values.');
    }

    /**
     * @dataProvider getLastData
     */
    public function testLast($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::last($_collection);
        $this->assertSame($expected, $result, 'last works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'last does not modify original collection values.');
    }

    /**
     * @dataProvider getLastData
     */
    public function testLastSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::last($_collection);
        $this->assertSame($expected, $result, 'last works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'last does not modify original collection values.');
    }

    /**
     * @dataProvider getMapData
     */
    public function testMap($expected, callable $function, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::map($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'map works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'map does not modify original collection values.');
    }

    /**
     * @dataProvider getMapData
     */
    public function testMapSimple($expected, callable $function, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::map($function, $_collection);
        $this->assertSame($expected, $result, 'map works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'map does not modify original collection values.');
    }

    /**
     * @dataProvider getMapIndexedData
     */
    public function testMapIndexed($expected, callable $function, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::mapIndexed($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'mapIndexed works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'mapIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getMapIndexedData
     */
    public function testMapIndexedSimple($expected, callable $function, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::mapIndexed($function, $_collection);
        $this->assertSame($expected, $result, 'mapIndexed works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'mapIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getMaxData
     */
    public function testMax($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::max($_collection);
        $this->assertSame($expected, $result, 'max works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'max does not modify original collection values.');
    }

    /**
     * @dataProvider getMaxData
     */
    public function testMaxSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::max($_collection);
        $this->assertSame($expected, $result, 'max works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'max does not modify original collection values.');
    }

    /**
     * @dataProvider getMaxByData
     */
    public function testMaxBy($expected, callable $getValue, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::maxBy($getValue, $_collection);
        $this->assertSame($expected, $result, 'maxBy works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'maxBy does not modify original collection values.');
    }

    /**
     * @dataProvider getMaxByData
     */
    public function testMaxBySimple($expected, callable $getValue, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::maxBy($getValue, $_collection);
        $this->assertSame($expected, $result, 'maxBy works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'maxBy does not modify original collection values.');
    }

    /**
     * @dataProvider getMinData
     */
    public function testMin($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::min($_collection);
        $this->assertSame($expected, $result, 'min works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'min does not modify original collection values.');
    }

    /**
     * @dataProvider getMinData
     */
    public function testMinSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::min($_collection);
        $this->assertSame($expected, $result, 'min works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'min does not modify original collection values.');
    }

    /**
     * @dataProvider getMinByData
     */
    public function testMinBy($expected, callable $getValue, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::minBy($getValue, $_collection);
        $this->assertSame($expected, $result, 'minBy works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'minBy does not modify original collection values.');
    }

    /**
     * @dataProvider getMinByData
     */
    public function testMinBySimple($expected, callable $getValue, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::minBy($getValue, $_collection);
        $this->assertSame($expected, $result, 'minBy works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'minBy does not modify original collection values.');
    }

    /**
     * @dataProvider getNoneData
     */
    public function testNone($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::none($predicate, $_collection);
        $this->assertSame($expected, $result, 'none works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'none does not modify original collection values.');
    }

    /**
     * @dataProvider getNoneData
     */
    public function testNoneSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::none($predicate, $_collection);
        $this->assertSame($expected, $result, 'none works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'none does not modify original collection values.');
    }

    /**
     * @dataProvider getPartitionData
     */
    public function testPartition($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::partition($predicate, $_collection);
        $this->assertSame($expected, $this->getCollectionGroupArray($result), 'partition works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'partition does not modify original collection values.');
    }

    /**
     * @dataProvider getPartitionData
     */
    public function testPartitionSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::partition($predicate, $_collection);
        $this->assertSame($expected, $result, 'partition works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'partition does not modify original collection values.');
    }

    /**
     * @dataProvider getPluckData
     */
    public function testPluck($expected, $name, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::pluck($name, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'pluck works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'pluck does not modify original collection values.');
    }

    /**
     * @dataProvider getPluckData
     */
    public function testPluckSimple($expected, $name, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::pluck($name, $_collection);
        $this->assertSame($expected, $result, 'pluck works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'pluck does not modify original collection values.');
    }

    /**
     * @dataProvider getPrependData
     */
    public function testPrepend($expected, $item, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::prepend($item, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'prepend works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'prepend does not modify original collection values.');
    }

    /**
     * @dataProvider getPrependData
     */
    public function testPrependSimple($expected, $item, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::prepend($item, $_collection);
        $this->assertSame($expected, $result, 'prepend works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'prepend does not modify original collection values.');
    }

    /**
     * @dataProvider getProductData
     */
    public function testProduct($expected, $values)
    {
        $_values = new ArrayCollection($values);
        $result  = Phamda::product($_values);
        $this->assertSame($expected, $result, 'product works for collection objects.');
        $this->assertSame($values, $_values->toArray(), 'product does not modify original collection values.');
    }

    /**
     * @dataProvider getProductData
     */
    public function testProductSimple($expected, $values)
    {
        $_values = new ArrayContainer($values);
        $result  = Phamda::product($_values);
        $this->assertSame($expected, $result, 'product works for simple collection objects.');
        $this->assertSame($values, $_values->toArray(), 'product does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduce($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::reduce($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduce works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduce does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduceSimple($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::reduce($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduce works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduce does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceIndexedData
     */
    public function testReduceIndexed($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::reduceIndexed($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduceIndexed works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduceIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceIndexedData
     */
    public function testReduceIndexedSimple($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::reduceIndexed($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduceIndexed works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduceIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceRightData
     */
    public function testReduceRight($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::reduceRight($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduceRight works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduceRight does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceRightData
     */
    public function testReduceRightSimple($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::reduceRight($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduceRight works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduceRight does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceRightIndexedData
     */
    public function testReduceRightIndexed($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::reduceRightIndexed($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduceRightIndexed works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduceRightIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getReduceRightIndexedData
     */
    public function testReduceRightIndexedSimple($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::reduceRightIndexed($function, $initial, $_collection);
        $this->assertSame($expected, $result, 'reduceRightIndexed works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reduceRightIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getRejectData
     */
    public function testReject($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::reject($predicate, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'reject works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reject does not modify original collection values.');
    }

    /**
     * @dataProvider getRejectData
     */
    public function testRejectSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::reject($predicate, $_collection);
        $this->assertSame($expected, $result, 'reject works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reject does not modify original collection values.');
    }

    /**
     * @dataProvider getRejectIndexedData
     */
    public function testRejectIndexed($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::rejectIndexed($predicate, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'rejectIndexed works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'rejectIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getRejectIndexedData
     */
    public function testRejectIndexedSimple($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::rejectIndexed($predicate, $_collection);
        $this->assertSame($expected, $result, 'rejectIndexed works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'rejectIndexed does not modify original collection values.');
    }

    /**
     * @dataProvider getReverseData
     */
    public function testReverse($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::reverse($_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'reverse works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reverse does not modify original collection values.');
    }

    /**
     * @dataProvider getReverseData
     */
    public function testReverseSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::reverse($_collection);
        $this->assertSame($expected, $result, 'reverse works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'reverse does not modify original collection values.');
    }

    /**
     * @dataProvider getSliceData
     */
    public function testSlice($expected, $start, $end, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::slice($start, $end, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'slice works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'slice does not modify original collection values.');
    }

    /**
     * @dataProvider getSliceData
     */
    public function testSliceSimple($expected, $start, $end, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::slice($start, $end, $_collection);
        $this->assertSame($expected, $result, 'slice works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'slice does not modify original collection values.');
    }

    /**
     * @dataProvider getSortData
     */
    public function testSort($expected, callable $comparator, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::sort($comparator, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'sort works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'sort does not modify original collection values.');
    }

    /**
     * @dataProvider getSortData
     */
    public function testSortSimple($expected, callable $comparator, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::sort($comparator, $_collection);
        $this->assertSame($expected, $result, 'sort works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'sort does not modify original collection values.');
    }

    /**
     * @dataProvider getSortByData
     */
    public function testSortBy($expected, callable $function, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::sortBy($function, $_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'sortBy works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'sortBy does not modify original collection values.');
    }

    /**
     * @dataProvider getSortByData
     */
    public function testSortBySimple($expected, callable $function, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::sortBy($function, $_collection);
        $this->assertSame($expected, $result, 'sortBy works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'sortBy does not modify original collection values.');
    }

    /**
     * @dataProvider getSumData
     */
    public function testSum($expected, $values)
    {
        $_values = new ArrayCollection($values);
        $result  = Phamda::sum($_values);
        $this->assertSame($expected, $result, 'sum works for collection objects.');
        $this->assertSame($values, $_values->toArray(), 'sum does not modify original collection values.');
    }

    /**
     * @dataProvider getSumData
     */
    public function testSumSimple($expected, $values)
    {
        $_values = new ArrayContainer($values);
        $result  = Phamda::sum($_values);
        $this->assertSame($expected, $result, 'sum works for simple collection objects.');
        $this->assertSame($values, $_values->toArray(), 'sum does not modify original collection values.');
    }

    /**
     * @dataProvider getTailData
     */
    public function testTail($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $result      = Phamda::tail($_collection);
        $this->assertSame($expected, $this->getCollectionArray($result), 'tail works for collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'tail does not modify original collection values.');
    }

    /**
     * @dataProvider getTailData
     */
    public function testTailSimple($expected, $collection)
    {
        $_collection = new ArrayContainer($collection);
        $result      = Phamda::tail($_collection);
        $this->assertSame($expected, $result, 'tail works for simple collection objects.');
        $this->assertSame($collection, $_collection->toArray(), 'tail does not modify original collection values.');
    }
}
