<?php

namespace Phamda\Tests;

use Phamda\Phamda;

class ConstructTest extends \PHPUnit_Framework_TestCase
{
    use BasicProvidersTrait, CurryTestTrait;

    /**
     * @dataProvider getConstructData
     */
    public function testConstruct($expected, $class, ...$arguments)
    {
        foreach ($this->getCurriedResults(Phamda::construct($class), ...$arguments) as $result) {
            $this->checkConstructResult($expected, $class, $result);
        }
    }

    /**
     * @dataProvider getConstructNData
     */
    public function testConstructN($expected, $arity, $class, ...$arguments)
    {
        foreach ($this->getCurriedResults(Phamda::construct($class, $arity), ...$arguments) as $result) {
            $this->checkConstructResult($expected, $class, $result);
        }
    }

    private function checkConstructResult($expectedString, $expectedClass, $result)
    {
        $this->assertInstanceOf($expectedClass, $result);
        $this->assertSame($expectedString, (string) $result);
    }
}