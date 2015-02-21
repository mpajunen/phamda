<?php

namespace Phamda\Tests;

use Phamda\Phamda;

class BasicTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getAllData
     */
    public function testAll($expected, callable $function, array $list)
    {
        $this->assertSame($expected, Phamda::all($function, $list));
        $curried0 = Phamda::all();
        $this->assertSame($expected, $curried0($function, $list));
        $curried1 = Phamda::all($function);
        $this->assertSame($expected, $curried1($list));
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
     * @dataProvider getAndData
     */
    public function testAnd($expected, callable $a, callable $b, ... $arguments)
    {
        $main0 = Phamda::and_($a, $b);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::and_();
        $main1    = $curried0($a, $b);
        $this->assertSame($expected, $main1(...$arguments));
        $curried1 = Phamda::and_($a);
        $main2    = $curried1($b);
        $this->assertSame($expected, $main2(...$arguments));
    }

    /**
     * @dataProvider getAnyData
     */
    public function testAny($expected, callable $function, array $list)
    {
        $this->assertSame($expected, Phamda::any($function, $list));
        $curried0 = Phamda::any();
        $this->assertSame($expected, $curried0($function, $list));
        $curried1 = Phamda::any($function);
        $this->assertSame($expected, $curried1($list));
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
     * @dataProvider getCurryData
     */
    public function testCurry($expected, callable $function, ... $arguments)
    {
        $main0 = Phamda::curry($function);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::curry();
        $main1    = $curried0($function);
        $this->assertSame($expected, $main1(...$arguments));
    }

    /**
     * @dataProvider getCurryNData
     */
    public function testCurryN($expected, $count, callable $function, ... $arguments)
    {
        $main0 = Phamda::curryN($count, $function);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::curryN();
        $main1    = $curried0($count, $function);
        $this->assertSame($expected, $main1(...$arguments));
        $curried1 = Phamda::curryN($count);
        $main2    = $curried1($function);
        $this->assertSame($expected, $main2(...$arguments));
    }

    /**
     * @dataProvider getEqData
     */
    public function testEq($expected, $a, $b)
    {
        $this->assertSame($expected, Phamda::eq($a, $b));
        $curried0 = Phamda::eq();
        $this->assertSame($expected, $curried0($a, $b));
        $curried1 = Phamda::eq($a);
        $this->assertSame($expected, $curried1($b));
    }

    /**
     * @dataProvider getFilterData
     */
    public function testFilter($expected, callable $function, array $list)
    {
        $this->assertSame($expected, Phamda::filter($function, $list));
        $curried0 = Phamda::filter();
        $this->assertSame($expected, $curried0($function, $list));
        $curried1 = Phamda::filter($function);
        $this->assertSame($expected, $curried1($list));
    }

    /**
     * @dataProvider getIdentityData
     */
    public function testIdentity($expected, $a)
    {
        $this->assertSame($expected, Phamda::identity($a));
        $curried0 = Phamda::identity();
        $this->assertSame($expected, $curried0($a));
    }

    /**
     * @dataProvider getMapData
     */
    public function testMap($expected, callable $function, array $list)
    {
        $this->assertSame($expected, Phamda::map($function, $list));
        $curried0 = Phamda::map();
        $this->assertSame($expected, $curried0($function, $list));
        $curried1 = Phamda::map($function);
        $this->assertSame($expected, $curried1($list));
    }

    /**
     * @dataProvider getNotData
     */
    public function testNot($expected, callable $function, ... $arguments)
    {
        $main0 = Phamda::not($function);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::not();
        $main1    = $curried0($function);
        $this->assertSame($expected, $main1(...$arguments));
    }

    /**
     * @dataProvider getOrData
     */
    public function testOr($expected, callable $a, callable $b, ... $arguments)
    {
        $main0 = Phamda::or_($a, $b);
        $this->assertSame($expected, $main0(...$arguments));
        $curried0 = Phamda::or_();
        $main1    = $curried0($a, $b);
        $this->assertSame($expected, $main1(...$arguments));
        $curried1 = Phamda::or_($a);
        $main2    = $curried1($b);
        $this->assertSame($expected, $main2(...$arguments));
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
    public function testReduce($expected, callable $function, $initial, array $list)
    {
        $this->assertSame($expected, Phamda::reduce($function, $initial, $list));
        $curried0 = Phamda::reduce();
        $this->assertSame($expected, $curried0($function, $initial, $list));
        $curried1 = Phamda::reduce($function);
        $this->assertSame($expected, $curried1($initial, $list));
        $curried2 = Phamda::reduce($function, $initial);
        $this->assertSame($expected, $curried2($list));
    }

    /**
     * @dataProvider getSortData
     */
    public function testSort($expected, callable $comparator, array $list)
    {
        $this->assertSame($expected, Phamda::sort($comparator, $list));
        $curried0 = Phamda::sort();
        $this->assertSame($expected, $curried0($comparator, $list));
        $curried1 = Phamda::sort($comparator);
        $this->assertSame($expected, $curried1($list));
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
