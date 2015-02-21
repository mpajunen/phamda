<?php

namespace Phamda\Tests;

use Phamda\Phamda;

class CurryTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getCurryNData
     */
    public function testCurryN($expected, $count, callable $function, ... $arguments)
    {
        $curried = Phamda::curryN($count, $function);

        foreach (range(1, $count - 1) as $index) {
            $new = $curried(...array_slice($arguments, 0, $index));
            $this->assertSame($expected, $new(...array_slice($arguments, $index)));
        }
    }
}
