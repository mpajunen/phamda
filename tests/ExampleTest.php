<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\Tests;

use Phamda\Phamda;

class ExampleTest extends \PHPUnit_Framework_TestCase
{
    public function testExample1()
    {
        $list = [5, 7, -3, 19, 0, 2];

        $isPositive = function ($x) { return $x > 0; };
        $result     = Phamda::filter($isPositive, $list);

        $this->assertSame([5, 7, 3 => 19, 5 => 2], $result);

        $double = function ($x) { return $x * 2; };
        $result = Phamda::map($double, $list);

        $this->assertSame([10, 14, -6, 38, 0, 4], $result);
    }

    public function testExample2()
    {
        $list = [5, 7, -3, 19, 0, 2];

        $isPositive = function ($x) { return $x > 0; };

        $getPositives = Phamda::filter($isPositive);
        $result       = $getPositives($list);

        $this->assertSame([5, 7, 3 => 19, 5 => 2], $result);
    }

    public function testExample3()
    {
        $double = function ($x) { return $x * 2; };

        $addFive          = function ($x) { return $x + 5; };
        $addFiveAndDouble = Phamda::compose($double, $addFive);
        $result           = $addFiveAndDouble(16);

        $this->assertSame(42, $result);
    }

    public function testExample4()
    {
        $products = [
            ['category' => 'QDT', 'weight' => 65.8, 'price' => 293.5, 'number' => 15708],
            ['number' => 59391, 'price' => 366.64, 'category' => 'NVG', 'weight' => 15.5],
            ['category' => 'AWK', 'number' => 89634, 'price' => 341.92, 'weight' => 35],
            ['price' => 271.8, 'weight' => 5.3, 'number' => 38718, 'category' => 'ETW'],
            ['price' => 523.63, 'weight' => 67.9, 'number' => 75905, 'category' => 'YVM'],
            ['price' => 650.31, 'weight' => 3.9, 'category' => 'XPA', 'number' => 46289],
            ['category' => 'WGX', 'weight' => 75.5, 'number' => 26213, 'price' => 471.44],
            ['category' => 'KCF', 'price' => 581.85, 'weight' => 31.9, 'number' => 48160],
        ];

        $process = Phamda::pipe(
            Phamda::filter(
                Phamda::pipe(
                    Phamda::prop('weight'),
                    Phamda::gt(50.0)
                )
            ),
            Phamda::map(
                Phamda::pick(['number', 'category', 'price'])
            ),
            Phamda::map(
                Phamda::map(
                    function ($value, $key) {
                        return $key === 'price' ? number_format($value, 2) : $value;
                    }
                )
            ),
            Phamda::sort(
                Phamda::comparator(
                    function ($a, $b) {
                        return $a['number'] < $b['number'];
                    }
                )
            )
        );

        $result = $process($products);

        $expected = [
            ['number' => 38718, 'category' => 'ETW', 'price' => '271.80'],
            ['number' => 46289, 'category' => 'XPA', 'price' => '650.31'],
            ['number' => 48160, 'category' => 'KCF', 'price' => '581.85'],
            ['number' => 59391, 'category' => 'NVG', 'price' => '366.64'],
            ['number' => 89634, 'category' => 'AWK', 'price' => '341.92'],
        ];

        $this->assertSame($expected, $result);
    }
}
