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

use Phamda\CodeGen\Builder\AbstractMethodBuilder;
use Phamda\CodeGen\Printer;
use Phamda\Phamda;
use PhpParser\Node\Param;

class MethodSignatureBuilder extends AbstractMethodBuilder
{
    public function getSignature()
    {
        $method = (new Printer())->prettyPrint([$this->build()->getNode()]);

        $process = Phamda::pipe(
            Phamda::explode("\n"),
            Phamda::first(),
            Phamda::curry('trim'),
            Phamda::curry('str_replace', 'function ', 'P::')
        );

        return $this->getReturnType() . ' ' . $process($method);
    }

    protected function createComment()
    {
        return '';
    }

    private function getReturnType()
    {
        $process = Phamda::pipe(
            $this->getTagPicker('@return'),
            Phamda::first(),
            Phamda::first()
        );

        return $process($this->source->getDocComment());
    }

    protected function createParams()
    {
        $setTypeHint = function ($type, Param $param) {
            $param->type = $type;

            return $param;
        };

        return Phamda::zipWith($setTypeHint, $this->getParamTypes(), $this->source->params);
    }

    private function getParamTypes()
    {
        $process = Phamda::pipe(
            $this->getTagPicker('@param'),
            Phamda::map(Phamda::first()),
            Phamda::curry('array_values')
        );

        return $process($this->source->getDocComment());
    }

    private function getTagPicker($tag)
    {
        return Phamda::pipe(
            Phamda::explode("\n"),
            Phamda::filter(Phamda::stringIndexOf($tag)),
            Phamda::map(
                Phamda::pipe(
                    Phamda::explode($tag),
                    Phamda::last(),
                    Phamda::curry('trim'),
                    Phamda::explode(' ')
                )
            )
        );
    }
}
