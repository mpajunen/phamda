<?php

namespace Phamda\Tests;

class Calculator
{
    public function addMany(... $arguments)
    {
        $result = 0;

        foreach ($arguments as $value) {
            $result += $value;
        }

        return $result;
    }

    public function addTwo($a, $b)
    {
        return $a + $b;
    }
}
