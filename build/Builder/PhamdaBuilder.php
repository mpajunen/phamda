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

use Phamda\CodeGen\Functions\FunctionCollection;
use Phamda\CodeGen\Functions\FunctionWrap;
use Phamda\Collection\Collection;
use Phamda\Exception\InvalidFunctionCompositionException;
use Phamda\Phamda;
use PhpParser\BuilderFactory;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\TraitUse;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\Stmt\UseUse;

class PhamdaBuilder implements BuilderInterface
{
    private $factory;
    private $functions;
    private $variables;

    public function __construct(FunctionCollection $functions, array $variables = [])
    {
        $this->factory   = new BuilderFactory();
        $this->functions = $functions;
        $this->variables = $variables;
    }

    public function build()
    {
        return $this->factory->namespace('Phamda')
            ->addStmt(new Use_([new UseUse(new Name(Collection::class))]))
            ->addStmt(new Use_([new UseUse(new Name(InvalidFunctionCompositionException::class))]))
            ->addStmt($this->createClass())
            ->getNode();
    }

    private function createClass()
    {
        return $this->factory->class('Phamda')
            ->setDocComment(GeneratedClassComment::create('The main API class of Phamda.'))
            ->addStmt(new TraitUse([new Name('CoreFunctionsTrait')]))
            ->addStmts($this->createClassMethods());
    }

    private function createClassMethods()
    {
        $create = function (FunctionWrap $function) { return (new MethodBuilder($function))->build(); };

        return Phamda::map($create, $this->functions->getFunctions());
    }
}
