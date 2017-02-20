<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\CodeGen\Functions;

use Phamda\Phamda;

class FunctionComment
{
    public $deprecation;
    public $parameters;
    public $return;
    public $summary;

    public function __construct($innerDoc)
    {
        $getRows = Phamda::pipe(
            Phamda::explode("\n"),
            Phamda::slice(1, -1),
            Phamda::map(Phamda::pipe(
                Phamda::explode('*'),
                Phamda::last(),
                Phamda::curry('trim')
            ))
        );

        $rows = $getRows($innerDoc);

        $hasSubstring = function ($subString, $string) { return strpos($string, $subString) !== false; };

        $firstParameter = Phamda::findIndex(Phamda::curry($hasSubstring, '@param'), $rows);
        $return         = Phamda::findIndex(Phamda::curry($hasSubstring, '@return'), $rows);
        $deprecation    = Phamda::findIndex(Phamda::curry($hasSubstring, '@deprecated'), $rows);

        $this->summary     = Phamda::slice(0, ($firstParameter ? $firstParameter : $return) - 1, $rows);
        $this->parameters  = Phamda::slice($firstParameter, $return - 1, $rows);
        $this->return      = $rows[$return];
        $this->deprecation = isset($deprecation) ? $rows[$deprecation] : null;
    }
}
