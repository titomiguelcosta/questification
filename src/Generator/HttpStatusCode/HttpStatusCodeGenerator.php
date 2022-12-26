<?php

namespace App\Generator\HttpStatusCode;

use App\Category;
use App\Generator\GeneratorInterface;
use App\Question\ExactAnswerQuestion;
use App\Question\MultipleChoiceOneAnswerQuestion;
use App\Question\QuestionInterface;

class HttpStatusCodeGenerator implements GeneratorInterface
{
    private $questionsGenerated = 0;
    private $data;
    private $statusCodes;
    private $asked = [];

    public function __construct()
    {
        $this->data = HttpStatusCodes::getData();
        $this->statusCodes = array_keys($this->data);
    }

    public function generate(?Category $category = null): ?QuestionInterface
    {
        ++$this->questionsGenerated;

        $unasked = array_diff($this->statusCodes, $this->asked);
        $code = $unasked[array_rand($unasked)];
        $this->asked[] = $code;

        $ask = sprintf('What is the status code for "%s"?', $this->data[$code]);

        if (false && 0 === rand(0, 1)) {
            $question = new ExactAnswerQuestion($ask, $code);
        } else {
            $question = new MultipleChoiceOneAnswerQuestion($ask, $code);

            $possibleChoices = array_flip(array_diff($this->statusCodes, [$code]));

            $choices = match (count($possibleChoices)) {
                0 => [$code], // maybe it would be a better idea to switch to exact answer question
                1 => [$code, key($possibleChoices)],
                default => [$code, ...array_rand($possibleChoices, min(3, count($possibleChoices)))],
            };

            shuffle($choices);
            $question->setChoices($choices);
        }

        $question->setCategory(Category::HTTP);

        return $question;
    }

    public function supportsCategory(Category $category): bool
    {
        return Category::HTTP === $category;
    }

    public function hasQuestions(?Category $category = null): bool
    {
        return $this->questionsGenerated < count($this->data);
    }
}
