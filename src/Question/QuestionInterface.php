<?php

namespace App\Question;

use App\Category;

interface QuestionInterface
{
    public function getQuestion(): string;

    public function getCorrectAnswer(): string;

    public function getAnswer(): ?string;

    public function setAnswer(string $answer);

    public function isAnswerCorrect(): bool;

    public function getCategory(): Category;
}
