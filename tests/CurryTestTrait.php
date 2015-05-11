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

/**
 * A helper for testing curried functions.
 */
trait CurryTestTrait
{
    public function getCurriedResults(callable $function, ...$arguments)
    {
        $results   = [];
        $arguments = $arguments ?: [];

        foreach (range(1, count($arguments)) as $index) {
            $curried = $function(...array_slice($arguments, 0, $index));

            $results[$index] = is_callable($curried) && $index < count($arguments)
                ? $curried(...array_slice($arguments, $index))
                : $curried;
        }

        return $results;
    }
}
