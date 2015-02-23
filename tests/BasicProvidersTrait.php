<?php

namespace Phamda\Tests;

use Phamda\Phamda;

trait BasicProvidersTrait
{
    public function getAddData()
    {
        return [
            [42, 15, 27],
            [28, 36, -8],
        ];
    }

    public function getAllData()
    {
        $isPositive = function($x) { return $x > 0; };

        return [
            [false, $isPositive, [1, 2, 0, -5]],
            [false, $isPositive, [-3, -7, -1, -5]],
            [true, $isPositive, [1, 2, 1, 11]],
        ];
    }

    public function getAndData()
    {
        $true  = function () { return true; };
        $false = function () { return false; };
        $equal = function($a, $b) { return $a == $b; };

        return [
            [true, $true, $true],
            [false, $true, $false],
            [false, $false, $true],
            [false, $false, $false],
            [true, $equal, $true, 2, 2],
            [false, $equal, $true, 2, 1],
            [false, $equal, $equal, 2, 1],
        ];
    }

    public function getAlwaysData()
    {
        $a = (object) ['foo' => 'bar'];

        return [
            [1, 1],
            [null, null],
            ['abc', 'abc'],
            [$a, $a],
        ];
    }

    public function getAnyData()
    {
        $isPositive = function($x) { return $x > 0; };

        return [
            [true, $isPositive, [1, 2, 0, -5]],
            [false, $isPositive, [-3, -7, -1, -5]],
            [true, $isPositive, [1, 2, 1, 11]],
        ];
    }

    public function getComparatorData()
    {
        return [
            [-1, Phamda::lt(), 1, 2],
            [0, Phamda::lt(), 1, 1],
            [1, Phamda::lt(), 2, 1],
        ];
    }

    public function getComposeData()
    {
        $square = function ($x) { return $x ** 2; };
        $sum    = function ($x, $y) { return $x + $y; };

        return [
            [256, [$square, $square], 4],
            [64, [$square, $sum], 3, 5],
            [2401, [$square, $square, $sum], 5, 2],
        ];
    }

    public function getCurryData()
    {
        $sum = function ($a, $b, $c, $d) { return $a + $b + $c + $d; };

        return [
            [1234, $sum, 1000, 200, 30, 4],
            [1234, $sum, 1000, 200, 30, 4, 5],
            [true, Phamda::eq(), 5, 5],
            [false, Phamda::eq(), 5, 7],
        ];
    }

    public function getCurryNData()
    {
        $sum = function ($a, $b, $c, $d) { return $a + $b + $c + $d; };

        return [
            [1234, 4, $sum, 1000, 200, 30, 4],
            [1234, 4, $sum, 1000, 200, 30, 4, 5],
            [true, 2, Phamda::eq(), 5, 5],
            [false, 2, Phamda::eq(), 5, 7],
        ];
    }

    public function getDivideData()
    {
        return [
            [5, 55, 11],
            [-6, 48, -8],
        ];
    }

    public function getEqData()
    {
        $x = (object) [];
        $y = (object) [];

        return [
            [true, 'a', 'a'],
            [false, 'a', 'b'],
            [true, null, null],
            [false, true, false],
            [false, null, false],
            [false, 0, false],
            [false, 'a', 'b'],
            [true, $x, $x],
            [false, $y, $x],
        ];
    }

    public function getFalseData()
    {
        return [
            [false],
        ];
    }

    public function getFilterData()
    {
        $gt2    = function ($x) { return $x > 2; };
        $isEven = function ($x) { return $x % 2 === 0; };

        return [
            [[2 => 3, 3 => 4], $gt2, [1, 2, 3, 4]],
            [[1 => 2, 3 => 4], $isEven, [1, 2, 3, 4]],
        ];
    }

    public function getFirstData()
    {
        $a = (object) [];
        $b = (object) [];
        $c = (object) [];

        return [
            [5, [5, 8, 9, 13]],
            [$a, [$a, $b, $c]],
        ];
    }

    public function getGtData()
    {
        return [
            [false, 1, 2],
            [false, 1, 1],
            [true, 2, 1],
        ];
    }

    public function getGteData()
    {
        return [
            [false, 1, 2],
            [true, 1, 1],
            [true, 2, 1],
        ];
    }

    public function getIdentityData()
    {
        $a = (object) ['foo' => 'bar'];

        return [
            [1, 1],
            [null, null],
            ['abc', 'abc'],
            [$a, $a],
        ];
    }

    public function getLastData()
    {
        $a = (object) [];
        $b = (object) [];
        $c = (object) [];

        return [
            [13, [5, 8, 9, 13]],
            [$c, [$a, $b, $c]],
        ];
    }

    public function getLtData()
    {
        return [
            [true, 1, 2],
            [false, 1, 1],
            [false, 2, 1],
        ];
    }

    public function getLteData()
    {
        return [
            [true, 1, 2],
            [true, 1, 1],
            [false, 2, 1],
        ];
    }

    public function getMapData()
    {
        $square = function ($x) { return $x ** 2; };

        return [
            [[1, 4, 9, 16], $square, [1, 2, 3, 4]],
            [[], $square, []],
        ];
    }

    public function getMaxData()
    {
        return [
            [15, [6, 15, 8, 9, -2, -3]],
            ['foo', ['bar', 'foo', 'baz']],
        ];
    }

    public function getMaxByData()
    {
        $getFoo = function ($item) { return $item->foo; };

        $a = (object) ['baz' => 3, 'bar' => 16, 'foo' => 5];
        $b = (object) ['baz' => 1, 'bar' => 25, 'foo' => 8];
        $c = (object) ['baz' => 14, 'bar' => 20, 'foo' => -2];

        return [
            [$b, $getFoo, [$a, $b, $c]],
            [$a, $getFoo, [$a, $c]],
        ];
    }

    public function getMinData()
    {
        return [
            [-3, [6, 15, 8, 9, -2, -3]],
            ['bar', ['bar', 'foo', 'baz']],
        ];
    }

    public function getMinByData()
    {
        $getBar = function ($item) { return $item->bar; };

        $a = (object) ['baz' => 3, 'bar' => 16, 'foo' => 5];
        $b = (object) ['baz' => 1, 'bar' => 25, 'foo' => 8];
        $c = (object) ['baz' => 14, 'bar' => 20, 'foo' => -2];

        return [
            [$a, $getBar, [$a, $b, $c]],
            [$c, $getBar, [$b, $c]],
        ];
    }

    public function getModuloData()
    {
        return [
            [3, 15, 6],
            [0, 22, 11],
            [-5, -23, 6],
        ];
    }

    public function getMultiplyData()
    {
        return [
            [405, 15, 27],
            [-288, 36, -8],
        ];
    }

    public function getNegateData()
    {
        return [
            [-15, 15],
            [0.7, -0.7],
            [0, 0],
        ];
    }

    public function getNoneData()
    {
        $isPositive = function($x) { return $x > 0; };

        return [
            [false, $isPositive, [1, 2, 0, -5]],
            [true, $isPositive, [-3, -7, -1, -5]],
            [false, $isPositive, [1, 2, 1, 11]],
        ];
    }

    public function getNotData()
    {
        $equal = function($a, $b) { return $a == $b; };

        return [
            [false, $equal, 1, 1],
            [true, $equal, 1, 2],
        ];
    }

    public function getOrData()
    {
        $true  = function () { return true; };
        $false = function () { return false; };
        $equal = function($a, $b) { return $a == $b; };

        return [
            [true, $true, $true],
            [true, $true, $false],
            [true, $false, $true],
            [false, $false, $false],
            [true, $equal, $true, 2, 2],
            [true, $equal, $true, 2, 1],
            [false, $equal, $equal, 2, 1],
        ];
    }

    public function getPickData()
    {
        $item = ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob'];

        return [
            [['bar' => 'bzz'], ['bar', 'fib'], $item],
            [[], ['fob', 'fib'], $item],
            [['bar' => 'bzz', 'foo' => null], ['bar', 'foo'], $item],
            [[], [], $item],
        ];
    }

    public function getPickAllData()
    {
        $item = ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob'];

        return [
            [['bar' => 'bzz', 'fib' => null], ['bar', 'fib'], $item],
            [['fob' => null, 'fib' => null], ['fob', 'fib'], $item],
            [['bar' => 'bzz', 'foo' => null], ['bar', 'foo'], $item],
            [[], [], $item],
        ];
    }

    public function getPipeData()
    {
        $sum    = function ($x, $y) { return $x + $y; };
        $square = function ($x) { return $x ** 2; };
        $triple = function ($x) { return 3 * $x; };

        return [
            [300, [$sum, $square, $triple], 2, 8],
            [675, [$triple, $square, $triple], 5],
        ];
    }

    public function getPluckData()
    {
        $items = [
            ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob'],
            ['foo' => 'fii', 'baz' => 'pob'],
        ];

        return [
            [[null, 'fii'], 'foo', $items],
            [['bob', 'pob'], 'baz', $items],
        ];
    }

    public function getProductData()
    {
        return [
            [-264, [11, -8, 3]],
            [720, [1, 2, 3, 4, 5, 6]],
        ];
    }

    public function getPropData()
    {
        $foo = ['bar' => 'fuz', 'baz' => null];

        return [
            ['fuz', 'bar', $foo],
            [null, 'baz', $foo],
            ['fuz', 'bar', (object) $foo],
            [null, 'baz', (object) $foo],
        ];
    }

    public function getPropEqData()
    {
        return [
            [true, 'foo', 'bar', ['foo' => 'bar']],
            [false, 'foo', 'baz', ['foo' => 'bar']],
            [true, 'foo', 'bar', (object) ['foo' => 'bar']],
            [false, 'foo', 'baz', (object) ['foo' => 'bar']],
        ];
    }

    public function getReduceData()
    {
        $concat = function ($x, $y) { return $x . $y; };
        $sum    = function ($x, $y) { return $x + $y; };

        return [
            [10, $sum, 0, [1, 2, 3, 4]],
            [20, $sum, 10, [1, 2, 3, 4]],
            [5, $sum, 5, []],
            ['xabcd', $concat, 'x', ['a', 'b', 'c', 'd']]
        ];
    }

    public function getRejectData()
    {
        $gt2    = function ($x) { return $x > 2; };
        $isEven = function ($x) { return $x % 2 === 0; };

        return [
            [[0 => 1, 1 => 2], $gt2, [1, 2, 3, 4]],
            [[0 => 1, 2 => 3], $isEven, [1, 2, 3, 4]],
        ];
    }

    public function getSortData()
    {
        $sub = function ($a, $b) { return $a - $b; };

        return [
            [[1, 2, 3, 4], $sub, [2, 4, 1, 3]],
        ];
    }

    public function getSubtractData()
    {
        return [
            [-12, 15, 27],
            [44, 36, -8],
        ];
    }

    public function getSumData()
    {
        return [
            [21, [1, 2, 3, 4, 5, 6]],
            [16, [11, 0, 2, -4, 7]],
        ];
    }

    public function getTrueData()
    {
        return [
            [true],
        ];
    }

    public function getZipData()
    {
        return [
            [[[1, 4], [2, 5], [3, 6]], [1, 2, 3], [4, 5, 6]],
            [['a' => [1, 3]], ['a' => 1, 'b' => 2], ['a' => 3, 'c' => 4]],
            [[], [1, 2, 3], []]
        ];
    }

    public function getZipWithData()
    {
        $sum = function ($x, $y) { return $x + $y; };

        return [
            [[5, 'a' => 7, 9], $sum, [1, 'a' => 2, 3], [4, 'a' => 5, 6]],
            [[6, 8], $sum, [1, 2, 3], [5, 6]],
            [[], $sum, [1, 2, 3], []],
        ];
    }
}
