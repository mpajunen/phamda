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

class ObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testTap()
    {
        $counter = new Counter();
        $addFive = function ($object) { $object->value += 5; };

        Phamda::tap($addFive, $counter);
        $this->assertSame(5, $counter->value);

        $addTap = Phamda::tap($addFive);
        $addTap($counter);
        $addTap($counter);
        $this->assertSame(15, $counter->value);
    }
}
