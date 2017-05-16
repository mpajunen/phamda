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

use Phamda\Phamda as P;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the highlighted examples in the readme file and documentation.
 */
class ExampleTest extends TestCase
{
    public function testCurriedExample()
    {
        $isPositive   = function ($x) { return $x > 0; };
        $list         = [5, 7, -3, 19, 0, 2];
        $getPositives = P::filter($isPositive);

        self::assertSame([5, 7, 3 => 19, 5 => 2], $getPositives($list));
    }

    public function testCurriedNativeExample()
    {
        $replaceBad = P::curry('str_replace', 'bad', 'good');

        self::assertSame('good day', $replaceBad('bad day'));
        self::assertSame('not good', $replaceBad('not bad'));
    }

    public function testComposeExample()
    {
        $double           = function ($x) { return $x * 2; };
        $addFive          = function ($x) { return $x + 5; };
        $addFiveAndDouble = P::compose($double, $addFive);

        self::assertSame(42, $addFiveAndDouble(16));

        $doubleAndAddFive = P::pipe($double, $addFive);

        self::assertSame(37, $doubleAndAddFive(16));
    }

    public function testFlipExample()
    {
        $pow   = function ($a, $b) { return $a ** $b; };
        $powOf = P::flip($pow);

        self::assertSame(256, $pow(2, 8));
        self::assertSame(64, $powOf(2, 8));
    }

    public function testTwistExample()
    {
        $redact = P::twist('substr_replace')('REDACTED', 5);

        self::assertSame('foobaREDACTED', $redact('foobarbaz'));
    }

    public function testProductList()
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

        $formatPrice = P::flip('number_format')(2);
        $process     = P::pipe(
            P::filter(// Only include products that...
                P::pipe(
                    P::prop('weight'), // ... weigh...
                    P::gt(50.0) // ... less than 50.0.
                )
            ),
            P::map(// For each product...
                P::pipe(// ... drop the weight field and fix field order:
                    P::pick(['number', 'category', 'price']),
                    // ... and format the price:
                    P::evolve(['price' => $formatPrice])
                )
            ),
            P::sortBy(// Sort the products by...
                P::prop('number') // ... comparing product numbers.
            )
        );

        $expected = [
            ['number' => 38718, 'category' => 'ETW', 'price' => '271.80'],
            ['number' => 46289, 'category' => 'XPA', 'price' => '650.31'],
            ['number' => 48160, 'category' => 'KCF', 'price' => '581.85'],
            ['number' => 59391, 'category' => 'NVG', 'price' => '366.64'],
            ['number' => 89634, 'category' => 'AWK', 'price' => '341.92'],
        ];

        self::assertSame($expected, $process($products));
    }
}
