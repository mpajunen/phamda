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

class PlaceholderTest extends \PHPUnit_Framework_TestCase
{
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
}
