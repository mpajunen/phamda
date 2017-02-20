<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\CodeGen\Builder;

use Phamda\Phamda;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt;

class MethodBuilder extends AbstractMethodBuilder
{
    const COMMENT_ROW_PREFIX = '     *';

    public function build()
    {
        return parent::build()->makeStatic();
    }

    protected function createComment()
    {
        $comment = $this->createBaseComment();

        return $this->source->isCurried() && ! $this->source->hasReturnType('callable')
            ? str_replace('* @return ', '* @return callable|', $comment)
            : $comment;
    }

    protected function createParams()
    {
        $setProp = function ($name, $value, Param $param) {
            $param->$name = $value;
        };

        $process = Phamda::pipe(
            Phamda::map(Phamda::clone_()),
            Phamda::each(Phamda::curry($setProp, 'type', null)),
            Phamda::each(Phamda::ifElse(
                Phamda::propEq('variadic', false),
                Phamda::curry($setProp, 'default', new Expr\ConstFetch(new Name('null'))),
                Phamda::identity()
            ))
        );

        return $process($this->source->params);
    }

    protected function createStatements()
    {
        return $this->source->isCurried()
            ? [new Stmt\Return_($this->getCurryWrap())]
            : $this->source->stmts;
    }

    private function getCurryWrap()
    {
        return new Expr\StaticCall(new Name('static'), 'curry' . $this->source->getArity(), [
            $this->source->getClosure(),
            new Arg(new Expr\FuncCall(new Name('func_get_args'))),
        ]);
    }

    private function createBaseComment()
    {
        $rows           = explode("\n", $this->source->getDocComment());
        $exampleStart   = Phamda::findIndex(Phamda::stringIndexOf('@'), $rows);
        $exampleProcess = $this->getExampleProcess();

        return implode("\n", array_merge(
            array_slice($rows, 0, $exampleStart),
            $exampleProcess((new CommentExampleBuilder($this->source))->getRows()),
            [self::COMMENT_ROW_PREFIX],
            array_slice($rows, $exampleStart)
        ));
    }

    private function getExampleProcess()
    {
        $process = Phamda::pipe(
            Phamda::prepend('```php'),
            Phamda::append('```'),
            Phamda::map(Phamda::concat(self::COMMENT_ROW_PREFIX . ' '))
        );

        return Phamda::ifElse(Phamda::isEmpty(), Phamda::identity(), $process);
    }
}
