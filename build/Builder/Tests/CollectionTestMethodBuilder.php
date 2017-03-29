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

use Phamda\CodeGen\Functions\FunctionWrap;
use Phamda\Phamda;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Param;
use PhpParser\Node\Scalar\String_;

class CollectionTestMethodBuilder extends BasicTestMethodBuilder
{
    private $simple;

    public function __construct(FunctionWrap $source, $simple)
    {
        parent::__construct($source);
        $this->simple = $simple;
    }

    protected function getName()
    {
        return $this->source->getHelperMethodName('test%s' . ($this->simple ? 'Simple' : ''));
    }

    protected function createParams()
    {
        $process = Phamda::pipe(
            Phamda::map(Phamda::clone_()),
            Phamda::prepend($this->factory->param('expected'))
        );

        return $process($this->source->params);
    }

    protected function createStatements()
    {
        return [
            $this->createCollectionAssignment(),
            $this->createResultAssignment(),
            $this->createResultAssert(),
            $this->createImmutabilityAssert(),
        ];
    }

    private function createCollectionAssignment()
    {
        return new Expr\Assign(
            new Expr\Variable('_' . $this->source->getCollectionArgumentName()),
            new Expr\New_(new Name($this->simple ? 'ArrayContainer' : 'ArrayCollection'), [
                new Expr\Variable($this->source->getCollectionArgumentName()),
            ])
        );
    }

    private function createResultAssignment()
    {
        return new Expr\Assign(
            new Expr\Variable('result'),
            $this->createFunctionCall()
        );
    }

    private function createResultAssert()
    {
        return new Expr\StaticCall(new Name('self'), 'assertSame', [
            new Expr\Variable('expected'),
            $this->createResultComparison(),
            new String_(sprintf('%s works for%s collection objects.', $this->source->getName(), $this->simple ? ' simple' : '')),
        ]);
    }

    private function createImmutabilityAssert()
    {
        return new Expr\StaticCall(new Name('self'), 'assertSame', [
            new Expr\Variable($this->source->getCollectionArgumentName()),
            new Expr\MethodCall(new Expr\Variable('_' . $this->source->getCollectionArgumentName()), 'toArray'),
            new String_(sprintf('%s does not modify original collection values.', $this->source->getName())),
        ]);
    }

    private function createResultComparison()
    {
        $result = new Expr\Variable('result');

        if ($this->simple && ! $this->source->hasReturnType('\Traversable')) {
        } elseif (! $this->simple && ! $this->source->hasReturnType('Collection') && ! $this->source->hasReturnType('Collection[]')) {
        } else {
            $helperMethod = $this->source->hasReturnType('Collection[]') ? 'getCollectionGroupArray' : 'getCollectionArray';

            $result = new Expr\StaticCall(new Name('self'), $helperMethod, [$result]);
        }

        return $result;
    }

    private function createFunctionCall()
    {
        return new Expr\StaticCall(new Name('P'), $this->source->getName(), $this->createArguments());
    }

    private function createArguments()
    {
        $create = function (Param $source) {
            $name = $source->name === $this->source->getCollectionArgumentName() ? '_' . $source->name : $source->name;

            return new Arg(new Expr\Variable($name), false, $source->variadic);
        };

        return Phamda::map($create, $this->source->params);
    }
}
