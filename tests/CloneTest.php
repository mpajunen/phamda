<?php

namespace Phamda\Tests;

use Phamda\Phamda;

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
