<?php

namespace Phamda\Tests;

use Phamda\Phamda;

class PhamdaTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getEqData
     */
    public function testEq($a, $b, $expected)
    {
        $this->assertEquals($expected, Phamda::eq($a, $b));
        $curried1 = Phamda::eq($a);
        $this->assertEquals($expected, $curried1($b));
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilter(callable $function, array $list, $expected)
    {
        $this->assertEquals($expected, Phamda::filter($function, $list));
        $curried1 = Phamda::filter($function);
        $this->assertEquals($expected, $curried1($list));
    }

    /**
     * @dataProvider getMapData
     */
    public function testMap(callable $function, array $list, $expected)
    {
        $this->assertEquals($expected, Phamda::map($function, $list));
        $curried1 = Phamda::map($function);
        $this->assertEquals($expected, $curried1($list));
    }

    /**
     * @dataProvider getPropEqData
     */
    public function testPropEq($name, $value, $object, $expected)
    {
        $this->assertEquals($expected, Phamda::propEq($name, $value, $object));
        $curried1 = Phamda::propEq($name);
        $this->assertEquals($expected, $curried1($value, $object));
        $curried2 = Phamda::propEq($name, $value);
        $this->assertEquals($expected, $curried2($object));
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduce(callable $function, $initial, array $list, $expected)
    {
        $this->assertEquals($expected, Phamda::reduce($function, $initial, $list));
        $curried1 = Phamda::reduce($function);
        $this->assertEquals($expected, $curried1($initial, $list));
        $curried2 = Phamda::reduce($function, $initial);
        $this->assertEquals($expected, $curried2($list));
    }

    /**
     * @dataProvider getSortData
     */
    public function testSort(callable $comparator, array $list, $expected)
    {
        $this->assertEquals($expected, Phamda::sort($comparator, $list));
        $curried1 = Phamda::sort($comparator);
        $this->assertEquals($expected, $curried1($list));
    }
}
