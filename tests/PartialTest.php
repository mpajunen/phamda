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

/**
 * Test partial application edge cases.
 */
class PartialTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getPartialData
     */
    public function testPartial($expected, callable $function, array $initialArguments, ... $arguments)
    {
        $partial = Phamda::partial($function, ...array_merge($initialArguments, $arguments));
        $this->assertSame($expected, $partial(), 'partial returns a function even if all arguments have been given.');
    }

    /**
     * @dataProvider getPartialNData
     */
    public function testPartialN($expected, $arity, callable $function, array $initialArguments, ... $arguments)
    {
        $partial = Phamda::partialN($arity, $function, ...array_merge($initialArguments, $arguments));
        $this->assertSame($expected, $partial(), 'partialN returns a function even if all arguments have been given.');
    }

    /**
     * @dataProvider getReduceData
     */
    public function testReduceRecurry($expected, callable $function, $initial, array $collection)
    {
        $curried0 = Phamda::reduce();
        $this->assertInstanceOf('\Closure', $curried0);
        $curried1 = $curried0($function);
        $this->assertInstanceOf('\Closure', $curried1);
        $curried2 = $curried1($initial);
        $this->assertInstanceOf('\Closure', $curried2);
        $result = $curried2($collection);
        $this->assertSame($expected, $result);
    }

    public function testRecurryN()
    {
        $curried = Phamda::curryN(5, function ($a, $b, $c, $d, $e) {
            return $a + $b + $c + $d + $e;
        });

        $curried1 = $curried(1);
        $this->assertInstanceOf('\Closure', $curried1);
        $curried2 = $curried1(2);
        $this->assertInstanceOf('\Closure', $curried2);
        $curried3 = $curried2(3);
        $this->assertInstanceOf('\Closure', $curried3);
        $curried4 = $curried3(4);
        $this->assertInstanceOf('\Closure', $curried4);
        $result = $curried4(5);
        $this->assertSame(15, $result);
    }
}
