<?php

namespace Phamda\Tests;

class ConstructableConcat
{
    private $string;

    public function __construct($a, $b, $c)
    {
        $this->string = $a . $b . $c;
    }

    public function __toString()
    {
        return $this->string;
    }
}
