<?php

namespace App;

use App\Generator\GeneratorInterface;

abstract class Engine
{
    protected $numQuestions = 10;
    protected $categories = [];
    protected $withCategories = false;

    abstract public function welcome(): void;

    abstract public function end(array $questions): void;

    public function __construct(iterable $generators, public iterable $renderers)
    {
        $this->generators = iterator_to_array($generators, false);
    }

    public function setNumQuestions(int $numQuestions): void
    {
        $this->numQuestions = $numQuestions;
    }

    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
        $this->withCategories = count($categories) > 0;
    }

    public function start(): void
    {
        $this->welcome();

        $questions = [];
        do {
            if (0 === count($this->generators)) {
                break;
            }

            $generator = null;
            if ($this->withCategories && 0 === count($this->categories)) {
                break;
            } elseif (count($this->categories) > 0) {
                $whichCategory = rand(0, count($this->categories) - 1);
                $category = $this->categories[$whichCategory];

                $generator = $this->pickGenerator($category);

                if (null === $generator) {
                    unset($this->categories[$whichCategory]);
                    $this->categories = array_values($this->categories);

                    continue;
                }
            } else {
                $generator = $this->pickGenerator();

                if (null === $generator) {
                    continue;
                }
            }

            $question = $generator->generate();

            foreach ($this->renderers as $renderer) {
                if ($renderer->supports($question)) {
                    $questions[] = $question;
                    $renderer->render($question);
                    
                    break;
                }
            }
        } while (count($questions) < $this->numQuestions);

        $this->end($questions);
    }

    private function pickGenerator(?Category $category = null): ?GeneratorInterface
    {
        $generator = null;

        shuffle($this->generators);

        if (!$category) {
            $generator = current($this->generators);

            if ($generator instanceof GeneratorInterface && !$generator->hasQuestions()) {
                array_shift($this->generators);
            }
        } else {
            /** @var GeneratorInterface */
            foreach ($this->generators as $potentialGenerator) {
                if ($potentialGenerator->supportsCategory($category) && $potentialGenerator->hasQuestions($category)) {
                    $generator = $potentialGenerator;

                    break;
                }
            }
        }

        return $generator;
    }
}
