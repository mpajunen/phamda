<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\CodeGen;

use PhpParser\Node\Expr;
use PhpParser\PrettyPrinter\Standard;

class Printer extends Standard
{
    public function pExpr_Array(Expr\Array_ $node)
    {
        return '[' . $this->pCommaSeparated($node->items) . ']';
    }

    public function pExpr_Closure(Expr\Closure $node)
    {
        return str_replace(' use(', ' use (', parent::pExpr_Closure($node));
    }
}
