<?php

/*
 * This file is part of the Phamda library
 *
 * (c) Mikael Pajunen <mikael.pajunen@gmail.com>
 *
 * For the full copyright and license information, please see the LICENSE
 * file that was distributed with this source code.
 */

namespace Phamda\Tests;

trait CurryTestTrait
{
    public function getCurriedResults(callable $function, ...$arguments)
    {
        $results = [];

        foreach (range(0, count($arguments)) as $index) {
            $curried = $function(...array_slice($arguments, 0, $index));

            $results[$index] = is_callable($curried)
                ? $curried(...array_slice($arguments, $index))
                : $curried;
        }

        return $results;
    }
}
