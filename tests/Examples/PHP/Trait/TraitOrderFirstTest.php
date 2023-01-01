<?php

namespace App\Tests\Examples\PHP\Trai;

use App\Examples\PHP\Trait\TraitOrderFirst;
use PHPUnit\Framework\TestCase;

class TraitOrderFirstTest extends TestCase
{
    public function testOutput(): void
    {
        $trait = new TraitOrderFirst();
        
        self::assertSame('hello from class', $trait->hello());
    }
}
