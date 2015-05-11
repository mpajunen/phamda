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
 * Test placeholder argument support.
 */
class PlaceholderTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getMapData
     */
    public function testMap($expected, callable $function, $collection)
    {
        $curried = Phamda::map(Phamda::_(), $collection);
        $this->assertSame($expected, $curried($function));
    }

    public function testSubtract()
    {
        $sub10 = Phamda::subtract(Phamda::_(), 10);
        $this->assertSame(42, $sub10(52));
    }

    public function testReduce()
    {
        $add15 = Phamda::reduce(Phamda::add(), Phamda::_(), [1, 2, 3, 4, 5]);
        $this->assertSame(25, $add15(10));
        $this->assertSame(42, $add15(27));
    }

    public function testSubstring()
    {
        $subFiveFive = Phamda::curryN(3, 'substr', Phamda::_(), 5, 5);
        $this->assertSame('fghij', $subFiveFive('abcdefghijklmn'));

        $sub         = Phamda::curryN(3, 'substr');
        $subFourFour = $sub(Phamda::_(), 4, 4);
        $this->assertSame('efgh', $subFourFour('abcdefghijklmn'));

        $subFour = $sub(Phamda::_(), Phamda::_(), 4);
        $this->assertSame('defg', $subFour('abcdefghijklmn', 3));

        $subFourAlpha = $subFour('abcdefghijklmn');
        $this->assertSame('ghij', $subFourAlpha(6));
        $this->assertSame('cdef', $subFourAlpha(2));
    }
}
