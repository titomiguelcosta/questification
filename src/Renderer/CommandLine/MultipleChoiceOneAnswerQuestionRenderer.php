<?php

namespace App\Renderer\CommandLine;

use App\Question\MultipleChoiceOneAnswerQuestion;
use App\Question\QuestionInterface;
use App\Renderer\RendererInterface;

class MultipleChoiceOneAnswerQuestionRenderer implements RendererInterface, SymfonyStyleInterface
{
    use SymfonyStyleTrait;

    /** @param MultipleChoiceOneAnswerQuestion $question */
    public function render(QuestionInterface $question): void
    {
        $this->io->text($question->getQuestion());

        $i = 1;
        $choices = $question->getChoices();
        foreach ($choices as $choice) {
            $this->io->text(sprintf('%s) %s', $i, $choice));
            $i++;
        }

        $answer = (int) $this->io->ask('Your answer');

        $question->setAnswer((string ) ($choices[$answer - 1] ?? ''));
    }

    public function supports(QuestionInterface $question): bool
    {
        return $question instanceof MultipleChoiceOneAnswerQuestion;
    }
}
