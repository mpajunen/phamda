<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\CodeGen\Builder\Tests;

use Phamda\CodeGen\Builder\BuilderInterface;
use Phamda\CodeGen\Builder\GeneratedClassComment;
use Phamda\CodeGen\Functions\FunctionCollection;
use Phamda\Phamda;
use PhpParser\BuilderFactory;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\TraitUse;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\Stmt\UseUse;
use PHPUnit\Framework\TestCase;

class BasicTestBuilder implements BuilderInterface
{
    private $functions;

    public function __construct(FunctionCollection $functions)
    {
        $this->functions = $functions;
    }

    public function build()
    {
        $factory = new BuilderFactory();

        return $factory->namespace('Phamda\Tests')
            ->addStmt(new Use_([new UseUse(new Name(Phamda::class), new Name('P'))]))
            ->addStmt(new Use_([new UseUse(new Name(TestCase::class))]))
            ->addStmt($this->createClass($factory))
            ->getNode();
    }

    private function createClass(BuilderFactory $factory)
    {
        return $factory->class('BasicTest')
            ->setDocComment(GeneratedClassComment::create('Test cases for basic functionality and currying.'))
            ->extend('TestCase')
            ->addStmt(new TraitUse([
                new Name('BasicProvidersTrait'),
            ]))
            ->addStmts($this->createClassMethods());
    }

    private function createClassMethods()
    {
        $create = Phamda::pipe(
            Phamda::reject(Phamda::unary(Phamda::invoker(0, 'returnsObject'))),
            Phamda::map(Phamda::pipe(
                Phamda::construct(BasicTestMethodBuilder::class),
                Phamda::invoker(0, 'build')
            ))
        );

        return $create($this->functions->getFunctions());
    }
}
