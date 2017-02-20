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

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\PrettyPrinter\Standard;

class Printer extends Standard
{
    public function pExpr_Array(Expr\Array_ $node)
    {
        return '[' . $this->pCommaSeparated($node->items) . ']';
    }

    public function pExpr_BooleanNot(Expr\BooleanNot $node)
    {
        return $this->pPrefixOp('Expr_BooleanNot', '! ', $node->expr);
    }

    public function pExpr_Closure(Expr\Closure $node)
    {
        return str_replace(' use(', ' use (', parent::pExpr_Closure($node));
    }

    protected function pStmts(array $nodes, $indent = true)
    {
        $result = '';
        /** @var Node $node */
        foreach ($nodes as $index => $node) {
            $result .= "\n"
                . ($this->isEmptyRowNeededBefore($node, $index, $nodes) ? $this->getEmptyRow() : '')
                . $this->pComments($node->getAttribute('comments', []))
                . $this->p($node)
                . ($node instanceof Expr ? ';' : '');
        }

        if ($indent) {
            return preg_replace('~\n(?!$|' . $this->noIndentToken . ')~', "\n    ", $result);
        } else {
            return $result;
        }
    }

    private function isEmptyRowNeededBefore(Node $node, $index, array $nodes)
    {
        return ($node instanceof Node\Stmt\Return_ && count($nodes) > 1)
            || ($node instanceof Node\Stmt\ClassMethod && $index !== 0)
            || $node instanceof Node\Stmt\Class_;
    }

    private function getEmptyRow()
    {
        return $this->noIndentToken . "\n";
    }
}
