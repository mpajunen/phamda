<?php

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
