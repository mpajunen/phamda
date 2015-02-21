<?php

namespace Phamda\Tests;

trait BasicProvidersTrait
{
    public function getAllData()
    {
        $isPositive = function($x) { return $x > 0; };

        return [
            [$isPositive, [1, 2, 0, -5], false],
            [$isPositive, [-3, -7, -1, -5], false],
            [$isPositive, [1, 2, 1, 11], true],
        ];
    }

    public function getAndData()
    {
        $true  = function () { return true; };
        $false = function () { return false; };
        $equal = function($a, $b) { return $a == $b; };

        return [
            [$true, $true, true],
            [$true, $false, false],
            [$false, $true, false],
            [$false, $false, false],
            [$equal, $true, true, 2, 2],
            [$equal, $true, false, 2, 1],
            [$equal, $equal, false, 2, 1],
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
            [$isPositive, [1, 2, 0, -5], true],
            [$isPositive, [-3, -7, -1, -5], false],
            [$isPositive, [1, 2, 1, 11], true],
        ];
    }

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
            [$square, [1, 2, 3, 4], [1, 4, 9, 16]],
            [$square, [], []],
        ];
    }

    public function getOrData()
    {
        $true  = function () { return true; };
        $false = function () { return false; };
        $equal = function($a, $b) { return $a == $b; };

        return [
            [$true, $true, true],
            [$true, $false, true],
            [$false, $true, true],
            [$false, $false, false],
            [$equal, $true, true, 2, 2],
            [$equal, $true, true, 2, 1],
            [$equal, $equal, false, 2, 1],
        ];
    }

    public function getPickData()
    {
        $item = ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob'];

        return [
            [['bar', 'fib'], $item, ['bar' => 'bzz']],
            [['fob', 'fib'], $item, []],
            [['bar', 'foo'], $item, ['bar' => 'bzz', 'foo' => null]],
            [[], $item, []],
        ];
    }

    public function getPickAllData()
    {
        $item = ['foo' => null, 'bar' => 'bzz', 'baz' => 'bob'];

        return [
            [['bar', 'fib'], $item, ['bar' => 'bzz', 'fib' => null]],
            [['fob', 'fib'], $item, ['fob' => null, 'fib' => null]],
            [['bar', 'foo'], $item, ['bar' => 'bzz', 'foo' => null]],
            [[], $item, []],
        ];
    }

    public function getPropData()
    {
        $foo = ['bar' => 'fuz', 'baz' => null];

        return [
            ['bar', $foo, 'fuz'],
            ['baz', $foo, null],
            ['bar', (object) $foo, 'fuz'],
            ['baz', (object) $foo, null],
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
            [$sub, [2, 4, 1, 3], [1, 2, 3, 4]],
        ];
    }

    public function getZipData()
    {
        return [
            [[1, 2, 3], [4, 5, 6], [[1, 4], [2, 5], [3, 6]]],
            [['a' => 1, 'b' => 2], ['a' => 3, 'c' => 4], ['a' => [1, 3]]],
            [[1, 2, 3], [], []]
        ];
    }

    public function getZipWithData()
    {
        $sum = function ($x, $y) { return $x + $y; };

        return [
            [$sum, [1, 'a' => 2, 3], [4, 'a' => 5, 6], [5, 'a' => 7, 9]],
            [$sum, [1, 2, 3], [5, 6], [6, 8]],
            [$sum, [1, 2, 3], [], []],
        ];
    }
}
