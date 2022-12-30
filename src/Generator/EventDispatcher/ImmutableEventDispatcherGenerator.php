<?php

namespace App\Generator\EventDispatcher;

use App\Category;
use App\Generator\GeneratorInterface;
use App\Question\MultipleChoiceOneAnswerQuestion;
use App\Question\QuestionInterface;

class ImmutableEventDispatcherGenerator implements GeneratorInterface
{
    private $asked = false;

    public function generate(?Category $category = null): ?QuestionInterface
    {
        $ask = 'Which exception is throw when trying to remove a listener from an ImmutableEventDispatcher?';

        $choices = [
            'FrozenEventDispatcherException',
            'BadMethodCallException',
            'InvalidArgumentException',
            'LogicException',
            'RuntimeException',
        ];
        shuffle($choices);

        $question = new MultipleChoiceOneAnswerQuestion($ask, 'BadMethodCallException');
        $question->setChoices($choices);

        $this->asked = true;
        $question->setCategory(Category::EVENT_DISPATCHER);

        return $question;
    }

    public function supportsCategory(Category $category): bool
    {
        return Category::EVENT_DISPATCHER === $category;
    }

    public function hasQuestions(?Category $category = null): bool
    {
        return !$this->asked;
    }
}
