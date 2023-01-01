<?php

namespace App\Generator\HTTP;

use App\Category;
use App\Generator\GeneratorInterface;
use App\Question\MultipleChoiceMultipleAnswersQuestion;
use App\Question\QuestionInterface;

class AcceptableHeaderGenerator implements GeneratorInterface
{
    private $asked = false;

    public function generate(?Category $category = null): ?QuestionInterface
    {
        $ask = 'Which acceptable request headers are valid?';

        $choices = [
            'Accept',
            'Accept-Method',
            'Accept-Language',
            'Accept-Charset',
            'Accept-Encoding',
        ];
        shuffle($choices);

        $question = new MultipleChoiceMultipleAnswersQuestion($ask, 'Accept, Accept-Language, Accept-Charset, Accept-Encoding');
        $question->setChoices($choices);
        $question->setCategory(Category::HTTP);

        $this->asked = true;

        return $question;
    }

    public function supportsCategory(Category $category): bool
    {
        return Category::HTTP === $category;
    }

    public function hasQuestions(?Category $category = null): bool
    {
        return !$this->asked;
    }
}
