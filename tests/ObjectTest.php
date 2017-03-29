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
    use BasicProvidersTrait;

    /**
     * @dataProvider getAssocData
     */
    public function testAssoc($expected, $property, $value, $object)
    {
        $realObject = (object) $object;
        $result     = P::assoc($property, $value, $realObject);

        self::assertNotSame($realObject, $result);
        self::assertSame($expected, (array) $result);
    }

    /**
     * @dataProvider getAssocPathData
     */
    public function testAssocPath($expected, array $path, $value, $object)
    {
        $realObject = (object) $object;
        $result     = P::assocPath($path, $value, $realObject);

        self::assertNotSame($realObject, $result);
        self::assertSame($expected, (array) $result);
    }

    public function testCast()
    {
        $object = (object) ['foo', 'bar'];

        self::assertSame(['foo', 'bar'], P::cast('array', $object));
        self::assertInstanceOf(\stdClass::class, $object);
    }

    public function testClone()
    {
        $original = new Test1();
        $clone    = P::clone_($original);

        self::assertNotSame($original, $clone);
        self::assertInstanceOf(Test1::class, $clone);

        $curried  = P::clone_();
        $newClone = $curried($original);

        self::assertNotSame($original, $newClone);
        self::assertInstanceOf(Test1::class, $newClone);
    }

    /**
     * @dataProvider getConstructData
     */
    public function testConstruct($expected, $class, $a, $b, ...$arguments)
    {
        $results = [
            P::construct($class, $a, $b, ...$arguments),
            P::construct()($class, $a, $b, ...$arguments),
            P::construct($class)($a, $b, ...$arguments),
            P::construct($class)($a)($b, ...$arguments),
            P::construct($class)($a)($b)(...$arguments),
        ];

        foreach ($results as $result) {
            self::checkConstructResult($expected, $class, $result);
        }
    }

    /**
     * @dataProvider getConstructNData
     */
    public function testConstructN($expected, $arity, $class, $a, $b, ...$arguments)
    {
        $results = [
            P::constructN($arity, $class, $a, $b, ...$arguments),
            P::constructN()($arity, $class, $a, $b, ...$arguments),
            P::constructN($arity)($class, $a, $b, ...$arguments),
            P::constructN($arity)($class)($a, $b, ...$arguments),
            P::constructN($arity, $class, $a)($b, ...$arguments),
            P::constructN($arity, $class)($a, $b, ...$arguments),
            P::constructN($arity, $class)($a)($b, ...$arguments),
        ];

        foreach ($results as $result) {
            self::checkConstructResult($expected, $class, $result);
        }
    }

    /**
     * @dataProvider getEvolveData
     */
    public function testEvolve($expected, array $transformations, $object)
    {
        $realObject = (object) $object;
        $result     = P::evolve($transformations, $realObject);

        self::assertNotSame($realObject, $result);
        self::assertSame($expected, (array) $result);
    }

    public function testTap()
    {
        $counter = new Counter();
        $addFive = function ($object) { $object->value += 5; };

        P::tap($addFive, $counter);
        self::assertSame(5, $counter->value);

        $addTap = P::tap($addFive);
        $addTap($counter);
        $addTap($counter);
        self::assertSame(15, $counter->value);
    }

    private static function checkConstructResult($expectedString, $expectedClass, $result)
    {
        self::assertInstanceOf($expectedClass, $result);
        self::assertSame($expectedString, (string) $result);
    }
}
