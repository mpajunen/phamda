<?php

namespace Phamda\Tests;

use Phamda\Phamda;

class CurryTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait, CurryTestTrait;

    /**
     * @dataProvider getCurryData
     */
    public function testCurry($expected, callable $function, ... $arguments)
    {
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
        $curried = Phamda::curryN($count, $function);

        foreach ($this->getCurriedResults($curried, ...$arguments) as $result) {
            $this->assertSame($expected, $result);
        }
    }
}
