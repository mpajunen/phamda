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

class ComposeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getTooFewParametersData
     * @expectedException \Phamda\Exception\InvalidFunctionCompositionException
     */
    public function testComposeThrowsWithTooFewParameters(... $functions)
    {
        Phamda::compose(... $functions);
    }

    /**
     * @dataProvider getTooFewParametersData
     * @expectedException \Phamda\Exception\InvalidFunctionCompositionException
     */
    public function testPipeThrowsWithTooFewParameters(... $functions)
    {
        Phamda::pipe(... $functions);
    }

    public function getTooFewParametersData()
    {
        return [
            [],
            [function () {}],
        ];
    }
}
