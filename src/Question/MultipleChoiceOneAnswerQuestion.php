<?php

namespace App\Question;

class MultipleChoiceOneAnswerQuestion extends BaseQuestion implements MultipleChoiceQuestionInterface
{
    private $choices = [];

    public function setChoices(array $choices): void
    {
        $this->choices = $choices;
    }

    public function getChoices(): array
    {
        return $this->choices;
    }
}
