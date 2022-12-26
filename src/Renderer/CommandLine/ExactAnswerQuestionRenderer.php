<?php

namespace App\Renderer\CommandLine;

use App\Question\ExactAnswerQuestion;
use App\Question\QuestionInterface;
use App\Renderer\RendererInterface;

class ExactAnswerQuestionRenderer implements RendererInterface, SymfonyStyleInterface
{
    use SymfonyStyleTrait;

    public function render(QuestionInterface $question): void
    {
        $this->io->text($question->getQuestion());

        $answer = (string) $this->io->ask('Your answer');

        $question->setAnswer($answer);
    }

    public function supports(QuestionInterface $question): bool
    {
        return $question instanceof ExactAnswerQuestion;
    }
}
