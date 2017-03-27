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

use Phamda\CodeGen\Builder\AbstractMethodBuilder;
use Phamda\CodeGen\Functions\FunctionWrap;
use Phamda\Phamda;
use PhpParser\BuilderFactory;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Param;
use PhpParser\Node\Scalar\String_;

class BasicTestMethodBuilder extends AbstractMethodBuilder
{
    protected $factory;

    public function __construct(FunctionWrap $source)
    {
        parent::__construct($source);
        $this->factory = new BuilderFactory();
    }

    protected function getName()
    {
        return $this->source->getHelperMethodName('test%s');
    }

    protected function createComment()
    {
        return <<<EOT
/**
 * @dataProvider {$this->source->getHelperMethodName('get%sData')}
 */
EOT;
    }

    protected function createParams()
    {
        $convertVariadic = function (Param $param) {
            if ($param->variadic) {
                $param->type     = 'array';
                $param->variadic = false;
            }
        };

        $process = Phamda::pipe(
            Phamda::flip(Phamda::merge())($this->source->getInnerFunctionParams()),
            Phamda::map(Phamda::clone_()),
            Phamda::each($convertVariadic),
            Phamda::prepend($this->factory->param('expected'))
        );

        return $process($this->source->params);
    }

    protected function createStatements()
    {
        return array_merge(
            [$this->createResultTestStatement()],
            $this->source->isCurried() ? $this->createCurryTestStatements() : []
        );
    }

    private function createResultTestStatement()
    {
        return $this->createAssert($this->createChainedCall([$this->source->params]), true);
    }

    private function createCurryTestStatements()
    {
        $getStatement = function ($index) {
            $toArray = function ($value) {
                return [$value];
            };

            $mainArguments = array_merge(
                [array_slice($this->source->params, 0, $index)],
                array_map($toArray, array_slice($this->source->params, $index))
            );

            return $this->createAssert($this->createChainedCall($mainArguments), false);
        };

        $startIndices = range(0, count($this->source->params) - 1);

        return array_map($getStatement, $startIndices);
    }

    private function createAssert(Expr $call, $isDirectCall)
    {
        return new Expr\MethodCall(new Expr\Variable('this'), 'assertSame', [
            new Expr\Variable('expected'),
            $call,
            new String_(sprintf($isDirectCall ? '%s produces correct results.' : '%s is curried correctly.', $this->source->getName())),
        ]);
    }

    private function createChainedCall(array $mainArguments)
    {
        $allArguments = array_merge(
            $mainArguments,
            $this->source->returnsCallable() ? [$this->source->getInnerFunctionParams()] : []
        );

        return array_reduce($allArguments, [$this, 'createFunctionCall']);
    }

    private function createFunctionCall($function, array $argumentSource)
    {
        $arguments = $this->createArguments($argumentSource);

        return $function !== null
            ? new Expr\FuncCall($function, $arguments)
            : new Expr\StaticCall(new Name('P'), $this->source->getName(), $arguments);
    }

    private function createArguments(array $sources)
    {
        $create = function (Param $source) {
            return new Arg(new Expr\Variable($source->name), false, $source->variadic);
        };

        return Phamda::map($create, $sources);
    }
}
