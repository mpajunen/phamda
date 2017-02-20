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

use Phamda\CodeGen\Builder\CommentExampleBuilder;
use Phamda\CodeGen\Functions\FunctionWrap;
use Phamda\Phamda;

class ListDocFunctionBuilder
{
    public static function getSection(FunctionWrap $function)
    {
        $parts = array_filter([
            sprintf('.. _%s:', $function->getName()),
            implode("\n", [
                $function->getName(),
                str_repeat('-', strlen($function->getName())),
                sprintf('``%s``', (new MethodSignatureBuilder($function))->getSignature()),
            ]),
            self::convertText([str_replace('@deprecated Since', 'Deprecated since', $function->getComment()->deprecation)]),
            self::convertText($function->getComment()->summary),
            self::getExamples($function),
        ]);

        return "\n\n" . implode("\n\n", $parts);
    }

    private static function convertText($text)
    {
        $process = Phamda::pipe(
            Phamda::implode("\n"),
            Phamda::explode('`'),
            Phamda::implode('``')
        );

        return $process($text);
    }

    private static function getExamples(FunctionWrap $function)
    {
        $process = Phamda::pipe(
            Phamda::construct(CommentExampleBuilder::class),
            Phamda::invoker(0, 'getRows'),
            Phamda::map(Phamda::concat('    ')),
            Phamda::ifElse(Phamda::isEmpty(), Phamda::identity(), Phamda::merge(['.. code-block:: php', ''])),
            Phamda::implode("\n")
        );

        return $process($function);
    }
}
