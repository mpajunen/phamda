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

use Phamda\CodeGen\Builder\BuilderInterface;
use Phamda\CodeGen\Builder\Docs\ListDocBuilder;
use Phamda\CodeGen\Builder\InnerFunctions;
use Phamda\CodeGen\Builder\PhamdaBuilder;
use Phamda\CodeGen\Builder\Tests\BasicTestBuilder;
use Phamda\CodeGen\Builder\Tests\CollectionTestBuilder;
use Phamda\CodeGen\Functions\FunctionCollection;
use Phamda\Tests\FunctionExampleTest;
use PhpParser\Node;
use PhpParser\ParserFactory;

class Generator
{
    public function generate($outDir)
    {
        $functions = $this->getSourceFunctions();
        $write     = function ($fileSubPath, $content) use ($outDir) {
            file_put_contents($outDir . '/' . $fileSubPath, $content . "\n");
        };

        $write('src/Phamda.php', $this->printClass(new PhamdaBuilder($functions)));
        $write('tests/BasicTest.php', $this->printClass(new BasicTestBuilder($functions)));
        $write('tests/CollectionTest.php', $this->printClass(new CollectionTestBuilder($functions)));
        $write('docs/functions.rst', (new ListDocBuilder($functions))->build());
    }

    private function printClass(BuilderInterface $builder)
    {
        return $this->getPhpFileComment() . (new Printer())->prettyPrint([$builder->build()]);
    }

    private function getSourceFunctions()
    {
        return new FunctionCollection(
            $this->getStatements(InnerFunctions::class),
            $this->getStatements(FunctionExampleTest::class)
        );
    }

    private function getStatements($class)
    {
        $file = (new \ReflectionClass($class))->getFileName();

        foreach ($this->parseFile($file)[0]->stmts as $node) {
            if ($node instanceof Node\Stmt\Class_) {
                return $node->stmts;
            }
        }

        throw new \LogicException(sprintf('Class "%s" statement not found in file "%s".', $class, $file));
    }

    private function parseFile($file)
    {
        return (new ParserFactory())->create(ParserFactory::ONLY_PHP7)->parse(file_get_contents($file));
    }

    private function getPhpFileComment()
    {
        return <<<EOT
<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */


EOT;
    }
}
