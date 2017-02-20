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
use Phamda\Tests\Fixtures\Counter;
use Phamda\Tests\Fixtures\Test1;
use PHPUnit\Framework\TestCase;

/**
 * Basic tests for functions with object return values.
 */
class ObjectTest extends TestCase
{
    use BasicProvidersTrait, CurryTestTrait;

    /**
     * @dataProvider getAssocData
     */
    public function testAssoc($expected, $property, $value, $object)
    {
        $realObject = (object) $object;
        $result     = P::assoc($property, $value, $realObject);

        $this->assertNotSame($realObject, $result);
        $this->assertSame($expected, (array) $result);
    }

    /**
     * @dataProvider getAssocPathData
     */
    public function testAssocPath($expected, array $path, $value, $object)
    {
        $realObject = (object) $object;
        $result     = P::assocPath($path, $value, $realObject);

        $this->assertNotSame($realObject, $result);
        $this->assertSame($expected, (array) $result);
    }

    public function testCast()
    {
        $object = (object) ['foo', 'bar'];

        $this->assertSame(['foo', 'bar'], P::cast('array', $object));
        $this->assertInstanceOf(\stdClass::class, $object);
    }

    public function testClone()
    {
        $original = new Test1();
        $clone    = P::clone_($original);

        $this->assertNotSame($original, $clone);
        $this->assertSame(Test1::class, get_class($clone));

        $curried  = P::clone_();
        $newClone = $curried($original);

        $this->assertNotSame($original, $newClone);
        $this->assertSame(Test1::class, get_class($newClone));
    }

    /**
     * @dataProvider getConstructData
     */
    public function testConstruct($expected, $class, ...$arguments)
    {
        foreach ($this->getCurriedResults(P::construct($class), ...$arguments) as $result) {
            $this->checkConstructResult($expected, $class, $result);
        }
    }

    /**
     * @dataProvider getConstructNData
     */
    public function testConstructN($expected, $arity, $class, ...$arguments)
    {
        foreach ($this->getCurriedResults(P::constructN($arity, $class), ...$arguments) as $result) {
            $this->checkConstructResult($expected, $class, $result);
        }
    }

    /**
     * @dataProvider getEvolveData
     */
    public function testEvolve($expected, array $transformations, $object)
    {
        $realObject = (object) $object;
        $result     = P::evolve($transformations, $realObject);

        $this->assertNotSame($realObject, $result);
        $this->assertSame($expected, (array) $result);
    }

    public function testTap()
    {
        $counter = new Counter();
        $addFive = function ($object) { $object->value += 5; };

        P::tap($addFive, $counter);
        $this->assertSame(5, $counter->value);

        $addTap = P::tap($addFive);
        $addTap($counter);
        $addTap($counter);
        $this->assertSame(15, $counter->value);
    }

    private function checkConstructResult($expectedString, $expectedClass, $result)
    {
        $this->assertInstanceOf($expectedClass, $result);
        $this->assertSame($expectedString, (string) $result);
    }
}
