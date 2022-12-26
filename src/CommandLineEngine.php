<?php

namespace App;

use App\Question\QuestionInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CommandLineEngine extends Engine
{
    private $io;

    public function setSymfonyStyle(SymfonyStyle $io)
    {
        $this->io = $io;
    }

    public function welcome(): void
    {
        $this->io->title('Are you ready? Test about to start. Good luck!');
    }

    public function end(array $questions): void
    {
        $rightAnswers = array_reduce(
            $questions, 
            fn (int $carry, QuestionInterface $question) => $carry + ($question->isAnswerCorrect() ? 1 : 0),
            0
        );

        $this->io->text(sprintf('You got right %d out of %d questions.', $rightAnswers, count($questions)));

        foreach ($questions as $question) {
            if (!$question->isAnswerCorrect()) {
                $this->io->error($question->getQuestion() . ' ' . $question->getCorrectAnswer());
            }
        }
    }
}