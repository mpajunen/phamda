<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\Exception;

class InvalidFunctionCompositionException extends \LogicException
{
    public static function create()
    {
        return new static('Compose / pipe requires at least two functions as arguments.');
    }
}
