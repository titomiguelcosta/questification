<?php

namespace App\Question;

use App\Category;

abstract class BaseQuestion implements QuestionInterface
{
    protected string $answer;
    protected Category $category;

    public function __construct(protected string $question, protected string $correctAnswer)
    {
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): Category
    {
        return $this->category ?? Category::UNKNOWN;
    }

    public function getCorrectAnswer(): string
    {
        return $this->correctAnswer;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    public function isAnswerCorrect(): bool
    {
        return $this->correctAnswer === $this->answer;
    }
}
