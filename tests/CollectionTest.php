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
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::all($predicate, $arrayCollection));
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAny($expected, callable $predicate, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::any($predicate, $arrayCollection));
    }

    /**
     * @dataProvider getContainsData
     */
    public function testContains($expected, $value, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::contains($value, $arrayCollection));
    }

    /**
     * @dataProvider getFindData
     */
    public function testFind($expected, callable $predicate, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::find($predicate, $arrayCollection));
    }

    /**
     * @dataProvider getFindIndexData
     */
    public function testFindIndex($expected, callable $predicate, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::findIndex($predicate, $arrayCollection));
    }

    /**
     * @dataProvider getFindLastData
     */
    public function testFindLast($expected, callable $predicate, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::findLast($predicate, $arrayCollection));
    }

    /**
     * @dataProvider getFindLastIndexData
     */
    public function testFindLastIndex($expected, callable $predicate, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::findLastIndex($predicate, $arrayCollection));
    }

    /**
     * @dataProvider getMaxData
     */
    public function testMax($expected, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::max($arrayCollection));
    }

    /**
     * @dataProvider getMaxByData
     */
    public function testMaxBy($expected, callable $getValue, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::maxBy($getValue, $arrayCollection));
    }

    /**
     * @dataProvider getMinData
     */
    public function testMin($expected, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::min($arrayCollection));
    }

    /**
     * @dataProvider getMinByData
     */
    public function testMinBy($expected, callable $getValue, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::minBy($getValue, $arrayCollection));
    }

    /**
     * @dataProvider getNoneData
     */
    public function testNone($expected, callable $predicate, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::none($predicate, $arrayCollection));
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduce($expected, callable $function, $initial, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::reduce($function, $initial, $arrayCollection));
    }

    /**
     * @dataProvider getReduceRightData
     */
    public function testReduceRight($expected, callable $function, $initial, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::reduceRight($function, $initial, $arrayCollection));
    }

    /**
     * @dataProvider getReverseData
     */
    public function testReverse($expected, $collection)
    {
        $arrayCollection = new ArrayCollection($collection);
        $this->assertSame($expected, Phamda::reverse($arrayCollection));
    }
}
