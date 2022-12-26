<?php

namespace App\Renderer\CommandLine;

use Symfony\Component\Console\Style\SymfonyStyle;

trait SymfonyStyleTrait
{
    private $io;

    public function setSymfonyStyle(SymfonyStyle $io): void
    {
        $this->io = $io;
    }
}