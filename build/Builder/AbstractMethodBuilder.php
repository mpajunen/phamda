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

use Phamda\CodeGen\Functions\FunctionWrap;
use PhpParser\Builder\Method;
use PhpParser\BuilderFactory;

class AbstractMethodBuilder implements BuilderInterface
{
    protected $source;

    public function __construct(FunctionWrap $source)
    {
        $this->source = $source;
    }

    /**
     * @return Method
     */
    public function build()
    {
        return (new BuilderFactory())->method($this->getName())
            ->setDocComment($this->createComment())
            ->addParams($this->createParams())
            ->addStmts($this->createStatements());
    }

    protected function getName()
    {
        return $this->source->getName();
    }

    protected function createComment()
    {
        return $this->source->getDocComment();
    }

    protected function createParams()
    {
        return $this->source->params;
    }

    protected function createStatements()
    {
        return $this->source->stmts;
    }
}
