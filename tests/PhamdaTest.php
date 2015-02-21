<?php

namespace Phamda\Tests;

use Phamda\Phamda;

class PhamdaTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getAllData
     */
    public function testAll(callable $function, array $list, $expected)
    {
        $this->assertSame($expected, Phamda::all($function, $list));
        $curried1 = Phamda::all($function);
        $this->assertSame($expected, $curried1($list));
    }

    /**
     * @dataProvider getAlwaysData
     */
    public function testAlways($value, $expected)
    {
        $wrapped = Phamda::always($value);
        $this->assertSame($expected, $wrapped());
    }

    /**
     * @dataProvider getAndData
     */
    public function testAnd(callable $a, callable $b, $expected, ... $arguments)
    {
        $main0 = Phamda::and_($a, $b);
        $this->assertSame($expected, $main0(...$arguments));
        $curried1 = Phamda::and_($a);
        $main1 = $curried1($b);
        $this->assertSame($expected, $main1(...$arguments));
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAny(callable $function, array $list, $expected)
    {
        $this->assertSame($expected, Phamda::any($function, $list));
        $curried1 = Phamda::any($function);
        $this->assertSame($expected, $curried1($list));
    }

    /**
     * @dataProvider getEqData
     */
    public function testEq($a, $b, $expected)
    {
        $this->assertSame($expected, Phamda::eq($a, $b));
        $curried1 = Phamda::eq($a);
        $this->assertSame($expected, $curried1($b));
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilter(callable $function, array $list, $expected)
    {
        $this->assertSame($expected, Phamda::filter($function, $list));
        $curried1 = Phamda::filter($function);
        $this->assertSame($expected, $curried1($list));
    }

    /**
     * @dataProvider getIdentityData
     */
    public function testIdentity($a, $expected)
    {
        $this->assertSame($expected, Phamda::identity($a));
    }

    /**
     * @dataProvider getMapData
     */
    public function testMap(callable $function, array $list, $expected)
    {
        $this->assertSame($expected, Phamda::map($function, $list));
        $curried1 = Phamda::map($function);
        $this->assertSame($expected, $curried1($list));
    }

    /**
     * @dataProvider getOrData
     */
    public function testOr(callable $a, callable $b, $expected, ... $arguments)
    {
        $main0 = Phamda::or_($a, $b);
        $this->assertSame($expected, $main0(...$arguments));
        $curried1 = Phamda::or_($a);
        $main1 = $curried1($b);
        $this->assertSame($expected, $main1(...$arguments));
    }

    /**
     * @dataProvider getPickData
     */
    public function testPick(array $names, array $item, $expected)
    {
        $this->assertSame($expected, Phamda::pick($names, $item));
        $curried1 = Phamda::pick($names);
        $this->assertSame($expected, $curried1($item));
    }

    /**
     * @dataProvider getPickAllData
     */
    public function testPickAll(array $names, array $item, $expected)
    {
        $this->assertSame($expected, Phamda::pickAll($names, $item));
        $curried1 = Phamda::pickAll($names);
        $this->assertSame($expected, $curried1($item));
    }

    /**
     * @dataProvider getPropData
     */
    public function testProp($name, $object, $expected)
    {
        $this->assertSame($expected, Phamda::prop($name, $object));
        $curried1 = Phamda::prop($name);
        $this->assertSame($expected, $curried1($object));
    }

    /**
     * @dataProvider getPropEqData
     */
    public function testPropEq($name, $value, $object, $expected)
    {
        $this->assertSame($expected, Phamda::propEq($name, $value, $object));
        $curried1 = Phamda::propEq($name);
        $this->assertSame($expected, $curried1($value, $object));
        $curried2 = Phamda::propEq($name, $value);
        $this->assertSame($expected, $curried2($object));
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduce(callable $function, $initial, array $list, $expected)
    {
        $this->assertSame($expected, Phamda::reduce($function, $initial, $list));
        $curried1 = Phamda::reduce($function);
        $this->assertSame($expected, $curried1($initial, $list));
        $curried2 = Phamda::reduce($function, $initial);
        $this->assertSame($expected, $curried2($list));
    }

    /**
     * @dataProvider getSortData
     */
    public function testSort(callable $comparator, array $list, $expected)
    {
        $this->assertSame($expected, Phamda::sort($comparator, $list));
        $curried1 = Phamda::sort($comparator);
        $this->assertSame($expected, $curried1($list));
    }

    /**
     * @dataProvider getZipData
     */
    public function testZip(array $a, array $b, $expected)
    {
        $this->assertSame($expected, Phamda::zip($a, $b));
        $curried1 = Phamda::zip($a);
        $this->assertSame($expected, $curried1($b));
    }

    /**
     * @dataProvider getZipWithData
     */
    public function testZipWith(callable $function, array $a, array $b, $expected)
    {
        $this->assertSame($expected, Phamda::zipWith($function, $a, $b));
        $curried1 = Phamda::zipWith($function);
        $this->assertSame($expected, $curried1($a, $b));
        $curried2 = Phamda::zipWith($function, $a);
        $this->assertSame($expected, $curried2($b));
    }
}
