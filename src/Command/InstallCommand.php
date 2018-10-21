<?php
namespace App\Command;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;
class InstallCommand extends Command
{
    protected static $defaultName = 'app:install';
    protected function configure()
    {
        $this
            ->setName('app:install')
            ->setDescription('Command to install the project')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Installation of the project');
        $io->progressStart(6);

        $io->newLine(4);
        $io->section('Installation of composer dependencies');
        $process = new Process('composer i');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });
        $process->wait();

        $io->newLine(20);
        $io->title('Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);
        $io->section('Installation of NodeJS dependencies');
        $process = new Process('npm i');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });
        $process->wait();

        $io->newLine(20);
        $io->title('Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);
        $io->section('Build Assets');
        $process = new Process('npm run build');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });
        $process->wait();
        $process->wait();

        $io->newLine(20);
        $io->title('Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);
        $io->section('Create DataBase');
        $process = new Process('bin/console doctrine:database:create');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });
        $process->wait();

        $io->newLine(20);
        $io->title('Installation of the project');
        $io->progressAdvance();
        $io->newLine(4);
        $io->section('Init DataBase');
        $process = new Process('bin/console doc:mig:mig');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });
        $process->wait();

        $io->newLine(20);
        $io->title('Fixtures');
        $io->progressAdvance();
        $io->newLine(4);
        $io->section('Create datas in bdd');
        $process = new Process('bin/console app:fixtures');
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($io, $output) {
            $output->writeln('> '.$buffer);
        });
        $process->wait();

        $io->progressFinish();
        $io->newLine(20);
        $io->newLine(2);
        $io->success('Yeah ! The project is installed ! You can check it out in your favourite web browser :D');
    }
}
