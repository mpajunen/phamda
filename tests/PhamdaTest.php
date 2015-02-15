<?php

namespace Phamda\Tests;

use Phamda\Phamda;

class PhamdaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getComposeData
     *
     * @param callable $a
     * @param callable $b
     * @param mixed    $expected
     * @param mixed    ...$params
     */
    public function testCompose(callable $a, callable $b, $expected, ...$params)
    {
        $composed = Phamda::compose($a, $b);

        $this->assertEquals($expected, $composed(...$params), 'Composed function produces correct results.');
    }

    public function getComposeData()
    {
        $square = function ($x) { return $x ** 2; };
        $sum    = function ($x, $y) { return $x + $y; };

        return [
            [$square, $square, 256, 4],
            [$square, $sum, 64, 3, 5],
        ];
    }

    /**
     * @dataProvider getFilterData
     *
     * @param callable $func
     * @param array    $list
     * @param array    $expected
     */
    public function testFilter(callable $func, array $list, array $expected)
    {
        $this->assertEquals($expected, Phamda::filter($func, $list), 'Filter filters array values.');

        $curried = Phamda::filter($func);

        $this->assertEquals($expected, $curried($list), 'Filter is automatically curried.');
    }

    public function getFilterData()
    {
        $isEven = function ($x) { return $x % 2 === 0; };

        return [
            [$isEven, [1, 2, 3, 4], [1 => 2, 3 => 4]],
        ];
    }

    /**
     * @dataProvider getMapData
     *
     * @param callable $func
     * @param array    $list
     * @param array    $expected
     */
    public function testMap(callable $func, array $list, array $expected)
    {
        $this->assertEquals($expected, Phamda::map($func, $list), 'Map maps array values.');

        $curried = Phamda::map($func);

        $this->assertEquals($expected, $curried($list), 'Map is automatically curried.');
    }

    public function getMapData()
    {
        $square = function ($x) { return $x ** 2; };

        return [
            [$square, [1, 2, 3, 4], [1, 4, 9, 16]],
            [$square, [], []],
        ];
    }

    /**
     * @dataProvider getReduceData
     *
     * @param callable $func
     * @param array    $list
     * @param mixed    $initial
     * @param mixed    $expected
     */
    public function testReduce(callable $func, array $list, $initial, $expected)
    {
        $this->assertEquals($expected, Phamda::reduce($func, $initial, $list), 'Reduce accumulates array values.');

        $curried = Phamda::reduce($func, $initial);

        $this->assertEquals($expected, $curried($list), 'Reduce is automatically curried.');
    }

    public function getReduceData()
    {
        $concat = function ($x, $y) { return $x . $y; };
        $sum    = function ($x, $y) { return $x + $y; };

        return [
            [$sum, [1, 2, 3, 4], 0, 10],
            [$sum, [1, 2, 3, 4], 10, 20],
            [$sum, [], 5, 5],
            [$concat, ['a', 'b', 'c', 'd'], 'x', 'xabcd']
        ];
    }
}
