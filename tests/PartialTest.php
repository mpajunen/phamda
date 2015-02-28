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

class PartialTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait, CurryTestTrait;

    /**
     * @dataProvider getCurryData
     */
    public function testCurry($expected, callable $function, ... $arguments)
    {
        $this->assertSame($expected, Phamda::curry($function, ...$arguments));

        $curried = Phamda::curry($function);

        foreach ($this->getCurriedResults($curried, ...$arguments) as $result) {
            $this->assertSame($expected, $result);
        }
    }

    /**
     * @dataProvider getCurryNData
     */
    public function testCurryN($expected, $count, callable $function, ... $arguments)
    {
        $this->assertSame($expected, Phamda::curryN($count, $function, ...$arguments));

        $curried = Phamda::curryN($count, $function);

        foreach ($this->getCurriedResults($curried, ...$arguments) as $result) {
            $this->assertSame($expected, $result);
        }
    }

    /**
     * @dataProvider getInvokerData
     */
    public function testInvoker($expected, $arity, $method, array $initialArguments, ... $arguments)
    {
        $main0 = Phamda::invoker($arity, $method, ...$initialArguments);
        $this->assertSame($expected, $main0(...$arguments));
    }

    /**
     * @dataProvider getPartialData
     */
    public function testPartial($expected, callable $function, array $initialArguments, ... $arguments)
    {
        $partial = Phamda::partial($function, ...$initialArguments);

        foreach ($this->getCurriedResults($partial, ...$arguments) as $result) {
            $this->assertSame($expected, $result);
        }
    }

    /**
     * @dataProvider getPartialNData
     */
    public function testPartialN($expected, $arity, callable $function, array $initialArguments, ... $arguments)
    {
        $partial = Phamda::partialN($arity, $function, ...$initialArguments);

        foreach ($this->getCurriedResults($partial, ...$arguments) as $result) {
            $this->assertSame($expected, $result);
        }
    }
}
