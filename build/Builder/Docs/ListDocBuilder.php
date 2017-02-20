<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\CodeGen\Builder\Docs;

use Phamda\CodeGen\Functions\FunctionCollection;
use Phamda\Phamda;

class ListDocBuilder
{
    private $functions;

    public function __construct(FunctionCollection $functions)
    {
        $this->functions = $functions;
    }

    public function build()
    {
        return $this->getHeader(count($this->functions))
            . $this->getPart('getSection');
    }

    private function getPart($method)
    {
        $process = Phamda::pipe(
            Phamda::map([ListDocFunctionBuilder::class, $method]),
            Phamda::implode("\n")
        );

        return $process($this->functions->getFunctions());
    }

    private function getHeader($count)
    {
        return <<<EOT
Phamda functions
================

Currently included functions ($count):


EOT;
    }
}
