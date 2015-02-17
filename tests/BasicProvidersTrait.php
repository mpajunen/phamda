<?php

namespace Phamda\Tests;

trait BasicProvidersTrait
{
    public function getEqData()
    {
        $x = (object) [];
        $y = (object) [];

        return [
            ['a', 'a', true],
            ['a', 'b', false],
            [null, null, true],
            [true, false, false],
            [null, false, false],
            [0, false, false],
            ['a', 'b', false],
            [$x, $x, true],
            [$y, $x, false],
        ];
    }

    public function getFilterData()
    {
        $isEven = function ($x) { return $x % 2 === 0; };

        return [
            [$isEven, [1, 2, 3, 4], [1 => 2, 3 => 4]],
        ];
    }

    public function getMapData()
    {
        $square = function ($x) { return $x ** 2; };

        return [
            [$square, [1, 2, 3, 4], [1, 4, 9, 16]],
            [$square, [], []],
        ];
    }

    public function getPropEqData()
    {
        return [
            ['foo', 'bar', ['foo' => 'bar'], true],
            ['foo', 'baz', ['foo' => 'bar'], false],
            ['foo', 'bar', (object) ['foo' => 'bar'], true],
            ['foo', 'baz', (object) ['foo' => 'bar'], false],
        ];
    }

    public function getReduceData()
    {
        $concat = function ($x, $y) { return $x . $y; };
        $sum    = function ($x, $y) { return $x + $y; };

        return [
            [$sum, 0, [1, 2, 3, 4], 10],
            [$sum, 10, [1, 2, 3, 4], 20],
            [$sum, 5, [], 5],
            [$concat, 'x', ['a', 'b', 'c', 'd'], 'xabcd']
        ];
    }

    public function getSortData()
    {
        $sub = function ($a, $b) { return $a - $b; };

        return [
            [$sub, [2, 4, 1, 3], [2 => 1, 0 => 2, 3 => 3, 1 => 4]],
        ];
    }
}
