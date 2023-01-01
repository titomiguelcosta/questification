<?php

namespace App\Tests\Examples\PHP\Trai;

use App\Examples\PHP\Trait\TraitOrderLast;
use PHPUnit\Framework\TestCase;

class TraitOrderLastTest extends TestCase
{
    public function testOutput(): void
    {
        $trait = new TraitOrderLast();
        
        self::assertSame('hello from class', $trait->hello());
    }
}
