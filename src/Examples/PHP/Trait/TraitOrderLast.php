<?php

namespace App\Examples\PHP\Trait;

class TraitOrderLast
{
    public function hello(): string
    {
        return 'hello from class';
    }

    use ExampleTrait;
}
