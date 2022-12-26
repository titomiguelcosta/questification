<?php

namespace App\Question;

interface MultipleChoiceQuestionInterface extends QuestionInterface
{
    public function getChoices(): array;
}
