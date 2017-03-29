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
 * Test partial application edge cases.
 */
class PartialTest extends TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getFlipData
     */
    public function testFlip($expected, callable $function, $a, $b, array $arguments)
    {
        self::assertSame($expected, P::flip($function)($a)($b, ...$arguments), 'flip returns a curried function.');
    }

    /**
     * @dataProvider getPartialData
     */
    public function testPartial($expected, callable $function, array $initialArguments, array $arguments)
    {
        $partial = P::partial($function, ...array_merge($initialArguments, $arguments));
        self::assertSame($expected, $partial(), 'partial returns a function even if all arguments have been given.');
    }

    /**
     * @dataProvider getPartialNData
     */
    public function testPartialN($expected, $arity, callable $function, array $initialArguments, array $arguments)
    {
        $partial = P::partialN($arity, $function, ...array_merge($initialArguments, $arguments));
        self::assertSame($expected, $partial(), 'partialN returns a function even if all arguments have been given.');
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduceRecurry($expected, callable $function, $initial, array $collection)
    {
        $curried0 = P::reduce();
        self::assertInstanceOf('\Closure', $curried0);
        $curried1 = $curried0($function);
        self::assertInstanceOf('\Closure', $curried1);
        $curried2 = $curried1($initial);
        self::assertInstanceOf('\Closure', $curried2);
        $result = $curried2($collection);
        self::assertSame($expected, $result);
    }

    public function testRecurryN()
    {
        $curried = P::curryN(5, function ($a, $b, $c, $d, $e) {
            return $a + $b + $c + $d + $e;
        });

        $curried1 = $curried(1);
        self::assertInstanceOf('\Closure', $curried1);
        $curried2 = $curried1(2);
        self::assertInstanceOf('\Closure', $curried2);
        $curried3 = $curried2(3);
        self::assertInstanceOf('\Closure', $curried3);
        $curried4 = $curried3(4);
        self::assertInstanceOf('\Closure', $curried4);
        $result = $curried4(5);
        self::assertSame(15, $result);
    }

    /**
     * @dataProvider getTwistData
     */
    public function testTwist($expected, callable $function, array $arguments)
    {
        $a = array_shift($arguments);

        self::assertSame($expected, P::twist($function)($a)(...$arguments), 'twist returns a curried function.');
    }

    /**
     * @dataProvider getTwistNData
     */
    public function testTwistN($expected, int $arity, callable $function, array $arguments)
    {
        $a = array_shift($arguments);

        self::assertSame($expected, P::twistN($arity, $function)($a)(...$arguments), 'twistN returns a curried function.');
    }
}
