<?php

namespace Phamda\Tests;

use Phamda\Phamda;

class PartialTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait;

    /**
     * @dataProvider getPartialData
     */
    public function testPartial($expected, callable $function, array $initialArguments, ... $arguments)
    {
        $partial = Phamda::partial($function, ...$initialArguments);
        $this->assertSame($expected, $partial(...$arguments));

        $this->curryTestFunction($expected, $partial, $arguments);
    }

    /**
     * @dataProvider getPartialNData
     */
    public function testPartialN($expected, $arity, callable $function, array $initialArguments, ... $arguments)
    {
        $partial = Phamda::partialN($arity, $function, ...$initialArguments);
        $this->assertSame($expected, $partial(...$arguments));

        $this->curryTestFunction($expected, $partial, $arguments);
    }

    private function curryTestFunction($expected, callable $function, array $arguments)
    {
        $index = 0;
        while (true) {
            $index++;
            $curried = $function(...array_slice($arguments, 0, $index));

            if (is_callable($curried)) {
                $this->assertSame($expected, $curried(...array_slice($arguments, $index)));
            } else {
                $this->assertSame($expected, $curried);
                break;
            }
        }
    }
}
