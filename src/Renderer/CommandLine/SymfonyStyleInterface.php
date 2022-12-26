<?php

namespace App\Renderer\CommandLine;

use Symfony\Component\Console\Style\SymfonyStyle;

interface SymfonyStyleInterface
{
    public function setSymfonyStyle(SymfonyStyle $symfonyStyle): void;
}
