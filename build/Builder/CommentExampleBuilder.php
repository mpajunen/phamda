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
use Phamda\CodeGen\Printer;
use Phamda\Phamda;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;

class CommentExampleBuilder
{
    const BASIC_EXAMPLE_COUNT = 3;

    private $source;

    public function __construct(FunctionWrap $source)
    {
        $this->source = $source;
    }

    public function getRows()
    {
        return $this->getCustomExamples() ?: $this->getBasicExamples();
    }

    private function getCustomExamples()
    {
        $statements = $this->getCustomExampleStatements();
        if (! $statements) {
            return [];
        }

        $printed = (new Printer())->prettyPrint($statements);

        $process = Phamda::pipe(
            Phamda::curry(
                'str_replace',
                ["\n\$placeholder =", "\n    ", "\n}"],
                [' // =>', ' ', ' }']),
            Phamda::explode("\n"),
            Phamda::map(function ($row) { return strpos($row, '//') !== false ? substr($row, 0, -1) : $row; })
        );

        return $process($printed);
    }

    private function getBasicExamples()
    {
        $helper = new ExampleHelper();
        $method = $this->source->getHelperMethodName('get%sData');
        if (! method_exists($helper, $method)) {
            return [];
        }

        $examples = [];
        foreach (array_slice($helper->$method(), 0, self::BASIC_EXAMPLE_COUNT) as $testData) {
            $examples[] = $this->getTestDataExample(...$testData);
        }

        return Phamda::reject(function ($example) { return strpos($example, '{') !== false; }, $examples);
    }

    private function getTestDataExample($expected, ...$parameters)
    {
        $print = function ($variable) use (&$print) {
            if (is_callable($variable)) {
                return '{function}';
            } elseif (is_array($variable)) {
                return $this->printArray($variable, $print);
            } elseif (is_string($variable)) {
                return "'$variable'";
            } elseif (is_numeric($variable)) {
                return $variable;
            } elseif (is_bool($variable)) {
                return $variable ? 'true' : 'false';
            } elseif (is_null($variable)) {
                return 'null';
            } else {
                return sprintf('{%s}', gettype($variable));
            }
        };

        return sprintf('P::%s(%s); // => %s',
            $this->source->getName(),
            implode(', ', array_map($print, $parameters)),
            $print($expected)
        );
    }

    private function printArray(array $values, callable $print)
    {
        $mapPrint = array_keys($values) === range(0, count($values) - 1)
            ? $print
            : function ($value, $key) use ($print) { return sprintf('%s => %s', $print($key), $print($value)); };

        return sprintf('[%s]', implode(', ', Phamda::map($mapPrint, $values)));
    }

    private function getCustomExampleStatements()
    {
        $statements = [];
        foreach ($this->source->getExampleStatements() as $statement) {
            if ($statement instanceof MethodCall && $statement->name === 'assertSame') {
                $statements[] = $statement->args[1]->value;
                $statements[] = new Assign(new Variable('placeholder'), $statement->args[0]->value);
            } else {
                $statements[] = $statement;
            }
        }

        return $statements;
    }
}
