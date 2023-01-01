<?php

namespace App\Examples\PHP\Trait;

class TraitOrderFirst 
{
    use ExampleTrait;

    public function hello(): string
    {
        return 'hello from class';
    }
}
