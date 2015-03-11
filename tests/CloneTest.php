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
use Phamda\Tests\Fixtures\Test1;

class CloneTest extends \PHPUnit_Framework_TestCase
{
    public function testClone()
    {
        $original = new Test1();
        $class    = get_class($original);
        $clone    = Phamda::clone_($original);

        $this->assertNotSame($original, $clone);
        $this->assertSame($class, get_class($clone));

        $curried  = Phamda::clone_();
        $newClone = $curried($original);

        $this->assertNotSame($original, $newClone);
        $this->assertSame($class, get_class($newClone));
    }
}
