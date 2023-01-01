<?php

namespace App\Renderer\CommandLine;

use App\Question\MultipleChoiceMultipleAnswersQuestion;
use App\Question\MultipleChoiceOneAnswerQuestion;
use App\Question\QuestionInterface;

class MultipleChoiceMultipleAnswersQuestionRenderer extends MultipleChoiceOneAnswerQuestionRenderer
{
    /** @param MultipleChoiceOneAnswerQuestion $question */
    public function render(QuestionInterface $question): void
    {
        $this->io->text($question->getQuestion());
        $this->io->warning('It is a multiple answer question (separate answers with commas)');

        $i = 1;
        $choices = $question->getChoices();
        foreach ($choices as $choice) {
            $this->io->text(sprintf('%s) %s', $i, $choice));
            ++$i;
        }

        $answer = $this->io->ask('Your answer');

        $answers = array_map(
            function ($key) use ($choices): string { return (string) ($choices[$key - 1] ?? ''); },
            explode(',', $answer)
        );

        $question->setAnswer(implode(',', $answers));
    }

    public function supports(QuestionInterface $question): bool
    {
        return $question instanceof MultipleChoiceMultipleAnswersQuestion;
    }
}
