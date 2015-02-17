<?php

namespace Phamda\Tests;

use Phamda\Phamda;

class CoreFunctionsTest extends \PHPUnit_Framework_TestCase
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
}
