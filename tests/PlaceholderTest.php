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
 * Test placeholder argument support.
 */
class PlaceholderTest extends TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getMapData
     */
    public function testMap($expected, callable $function, $collection)
    {
        $curried = P::map(P::_(), $collection);
        $this->assertSame($expected, $curried($function));
    }

    public function testSubtract()
    {
        $sub10 = P::subtract(P::_(), 10);
        $this->assertSame(42, $sub10(52));
    }

    public function testReduce()
    {
        $add15 = P::reduce(P::add(), P::_(), [1, 2, 3, 4, 5]);
        $this->assertSame(25, $add15(10));
        $this->assertSame(42, $add15(27));
    }

    public function testSubstring()
    {
        $subFiveFive = P::curryN(3, 'substr', P::_(), 5, 5);
        $this->assertSame('fghij', $subFiveFive('abcdefghijklmn'));

        $sub         = P::curryN(3, 'substr');
        $subFourFour = $sub(P::_(), 4, 4);
        $this->assertSame('efgh', $subFourFour('abcdefghijklmn'));

        $subFour = $sub(P::_(), P::_(), 4);
        $this->assertSame('defg', $subFour('abcdefghijklmn', 3));

        $subFourAlpha = $subFour('abcdefghijklmn');
        $this->assertSame('ghij', $subFourAlpha(6));
        $this->assertSame('cdef', $subFourAlpha(2));
    }
}
