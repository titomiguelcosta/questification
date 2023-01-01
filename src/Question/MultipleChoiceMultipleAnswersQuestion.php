<?php

namespace App\Question;

class MultipleChoiceMultipleAnswersQuestion extends BaseQuestion implements MultipleChoiceQuestionInterface
{
    private $choices = [];

    public function __construct(protected string $question, string $correctAnswer)
    {
        $this->correctAnswer = $this->processAnswer($correctAnswer);
    }

    public function setChoices(array $choices): void
    {
        $this->choices = $choices;
    }

    public function getChoices(): array
    {
        return $this->choices;
    }

    public function setAnswer(string $answer): void
    {
        $this->answer = $this->processAnswer($answer);
    }

    private function processAnswer(string $answer): string
    {
        $answers = array_map(fn ($answer) => trim($answer), explode(',', trim($answer)));

        sort($answers);

        return implode(',', $answers);
    }
}
