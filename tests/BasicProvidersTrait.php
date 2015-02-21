<?php

namespace Phamda\Tests;

trait BasicProvidersTrait
{
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

    public function getFilterData()
    {
        $isEven = function ($x) { return $x % 2 === 0; };

        return [
            [[1 => 2, 3 => 4], $isEven, [1, 2, 3, 4]],
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

    public function getMapData()
    {
        $square = function ($x) { return $x ** 2; };

        return [
            [[1, 4, 9, 16], $square, [1, 2, 3, 4]],
            [[], $square, []],
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

    public function getSortData()
    {
        $sub = function ($a, $b) { return $a - $b; };

        return [
            [[1, 2, 3, 4], $sub, [2, 4, 1, 3]],
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
