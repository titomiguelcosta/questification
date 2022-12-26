<?php

namespace App\Generator\Psr;

use App\Category;
use App\Generator\GeneratorInterface;
use App\Question\ExactAnswerQuestion;
use App\Question\QuestionInterface;

class PsrExactAnswerGenerator implements GeneratorInterface
{
    private $questionsGenerated = 0;
    private $data;
    private $asked = [];

    public function __construct()
    {
        $this->data = [
            '0' => 'Autoloading Standard*',
            '1' => 'Basic Coding Standard',
            '2' => 'Coding Style Guide*',
            '3' => 'Logger Interface',
            '4' => 'Autoloading Standard',
            '5' => 'PHPDoc Standard*',
            '6' => 'Caching Interface',
            '7' => 'HTTP Message Interface',
            '8' => 'Huggable Interface*',
            '9' => 'Security Advisories*',
            '10' => 'Security Reporting Process*',
            '11' => 'Container Interface',
            '12' => 'Extended Coding Style Guide',
            '13' => 'Hypermedia Links',
            '14' => 'Event Dispatcher',
            '15' => 'HTTP Handlers',
            '16' => 'Simple Cache',
            '17' => 'HTTP Factories',
            '18' => 'HTTP Client',
            '19' => 'PHPDoc tags*',
            '20' => 'Clock',
            '21' => 'Internationalization*',
            '22' => 'Application Tracing*',
        ];
    }

    public function generate(?Category $category = null): ?QuestionInterface
    {
        ++$this->questionsGenerated;

        $unasked = array_diff(array_keys($this->data), $this->asked);
        $code = $unasked[array_rand($unasked)];
        $this->asked[] = $code;

        $question = new ExactAnswerQuestion(sprintf('What is the PSR for "%s"?', $this->data[$code]), $code);
        $question->setCategory(Category::PHP);

        return $question;
    }

    public function supportsCategory(Category $category): bool
    {
        return Category::PHP === $category;
    }

    public function hasQuestions(?Category $category = null): bool
    {
        return $this->questionsGenerated < count($this->data);
    }
}
