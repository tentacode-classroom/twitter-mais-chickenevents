<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\ArrayInput;

class InstallCommand extends Command
{
    protected static $defaultName = 'app:install';

    protected function configure()
    {
        $this
            ->setDescription('Install the project');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("maxence t moche");
    }
}
