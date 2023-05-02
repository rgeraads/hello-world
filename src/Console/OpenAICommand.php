<?php

declare(strict_types=1);

namespace App\Console;
use App\OpenAI\Language;
use App\OpenAI\OpenAIClient;
use App\OpenAI\Responder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class OpenAICommand extends Command
{
    public function __construct(private OpenAIClient $openAIClient)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('openai:ask');
        $this->addArgument('question', InputArgument::REQUIRED, 'Your question');
        $this->addOption('responder', null, InputOption::VALUE_REQUIRED, 'Who do you want to respond to you?');
        $this->addOption('language', null, InputOption::VALUE_REQUIRED, 'what language do you want your answer in?');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getOption('responder')) {
            $this->openAIClient->setResponder(Responder::tryFrom(strtolower($input->getOption('responder'))));
        }

        if ($input->getOption('language')) {
            $this->openAIClient->setLanguage(Language::tryFrom(strtolower($input->getOption('language'))));
        }

        $answer = $this->openAIClient->ask($input->getArgument('question'));

        $output->writeln($answer);

        return Command::SUCCESS;
    }
}
