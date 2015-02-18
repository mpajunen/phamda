<?php

namespace Phamda\Tests;

use Phamda\Phamda;

class CoreFunctionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getAndData
     *
     * @param callable $a
     * @param callable $b
     * @param bool     $expected
     * @param mixed    ...$params
     */
    public function testAnd(callable $a, callable $b, $expected, ...$params)
    {
        $and = Phamda::and_($a, $b);

        $this->assertEquals($expected, $and(...$params));

        $curry1 = Phamda::and_($a);
        $and1   = $curry1($b);

        $this->assertEquals($expected, $and1(...$params));
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
     * @dataProvider getNotData
     *
     * @param callable $a
     * @param bool     $expected
     * @param mixed    ...$params
     */
    public function testNot(callable $a, $expected, ...$params)
    {
        $notA = Phamda::not($a);

        $this->assertEquals($expected, $notA(...$params));
    }

    public function getNotData()
    {
        $equal = function($a, $b) { return $a == $b; };

        return [
            [$equal, false, 1, 1],
            [$equal, true, 1, 2],
        ];
    }
    /**
     * @dataProvider getOrData
     *
     * @param callable $a
     * @param callable $b
     * @param bool     $expected
     * @param mixed    ...$params
     */
    public function testOr(callable $a, callable $b, $expected, ...$params)
    {
        $and = Phamda::or_($a, $b);

        $this->assertEquals($expected, $and(...$params));

        $curry1 = Phamda::or_($a);
        $and1   = $curry1($b);

        $this->assertEquals($expected, $and1(...$params));
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
}
