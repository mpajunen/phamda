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

use Doctrine\Common\Collections\ArrayCollection;
use Phamda\Phamda;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getAllData
     */
    public function testAll($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::all($predicate, $_collection));
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAny($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::any($predicate, $_collection));
    }

    /**
     * @dataProvider getContainsData
     */
    public function testContains($expected, $value, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::contains($value, $_collection));
    }

    /**
     * @dataProvider getFindData
     */
    public function testFind($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::find($predicate, $_collection));
    }

    /**
     * @dataProvider getFindIndexData
     */
    public function testFindIndex($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::findIndex($predicate, $_collection));
    }

    /**
     * @dataProvider getFindLastData
     */
    public function testFindLast($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::findLast($predicate, $_collection));
    }

    /**
     * @dataProvider getFindLastIndexData
     */
    public function testFindLastIndex($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::findLastIndex($predicate, $_collection));
    }

    /**
     * @dataProvider getFirstData
     */
    public function testFirst($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::first($_collection));
    }

    /**
     * @dataProvider getIndexOfData
     */
    public function testIndexOf($expected, $item, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::indexOf($item, $_collection));
    }

    /**
     * @dataProvider getIsEmptyData
     */
    public function testIsEmpty($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::isEmpty($_collection));
    }

    /**
     * @dataProvider getLastData
     */
    public function testLast($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::last($_collection));
    }

    /**
     * @dataProvider getMaxData
     */
    public function testMax($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::max($_collection));
    }

    /**
     * @dataProvider getMaxByData
     */
    public function testMaxBy($expected, callable $getValue, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::maxBy($getValue, $_collection));
    }

    /**
     * @dataProvider getMinData
     */
    public function testMin($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::min($_collection));
    }

    /**
     * @dataProvider getMinByData
     */
    public function testMinBy($expected, callable $getValue, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::minBy($getValue, $_collection));
    }

    /**
     * @dataProvider getNoneData
     */
    public function testNone($expected, callable $predicate, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::none($predicate, $_collection));
    }

    /**
     * @dataProvider getProductData
     */
    public function testProduct($expected, $values)
    {
        $_values = new ArrayCollection($values);
        $this->assertSame($expected, Phamda::product($_values));
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduce($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::reduce($function, $initial, $_collection));
    }

    /**
     * @dataProvider getReduceRightData
     */
    public function testReduceRight($expected, callable $function, $initial, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::reduceRight($function, $initial, $_collection));
    }

    /**
     * @dataProvider getReverseData
     */
    public function testReverse($expected, $collection)
    {
        $_collection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::reverse($_collection));
    }

    /**
     * @dataProvider getSumData
     */
    public function testSum($expected, $values)
    {
        $_values = new ArrayCollection($values);
        $this->assertSame($expected, Phamda::sum($_values));
    }
}
