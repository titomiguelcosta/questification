<?php

namespace App\Renderer;

use App\Question\QuestionInterface;

interface RendererInterface
{
    public function render(QuestionInterface $question): void;

    public function supports(QuestionInterface $question): bool;
}
