<?php

namespace App\Command;

use App\Category;
use App\CommandLineEngine;
use App\Renderer\CommandLine\SymfonyStyleInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:test',
    description: 'Add a short description for your command',
)]
class TestCommand extends Command
{
    private $io;

    public function __construct(private CommandLineEngine $engine)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('categories', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Categories you would like to include in the test')
            ->addOption('total', null, InputOption::VALUE_REQUIRED, 'Total number of questions', 5)
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->engine->setSymfonyStyle($this->io);
        
        foreach ($this->engine->renderers as $renderer) {
            if ($renderer instanceof SymfonyStyleInterface) {
                $renderer->setSymfonyStyle($this->io);
            }
        } 
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->engine->setNumQuestions((int) $input->getOption('total'));

        $categories = [];
        foreach ($input->getOption('categories') as $category) {
            $categories[] = Category::from($category);
        }

        $this->engine->setCategories($categories);
        $this->engine->start();

        return Command::SUCCESS;
    }
}
