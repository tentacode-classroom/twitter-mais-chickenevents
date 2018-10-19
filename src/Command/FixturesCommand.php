<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Nelmio\Alice\Loader\NativeLoader;
use Doctrine\ORM\EntityManagerInterface;

class FixturesCommand extends Command
{
    protected static $defaultName = 'app:fixtures';
    private $manager;


    public function __construct( EntityManagerInterface $manager, ?string $name = null )
    {
        parent::__construct($name);
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $loader = new NativeLoader();
        $loader->getFakerGenerator()->seed(1234);
        $objectSet = $loader->loadFile( __DIR__ . '/fixtures.yml');

        foreach ( $objectSet->getObjects() as $object ) {
//            var_dump($object);
            $this->manager->persist( $object );
        }

        $this->manager->flush();

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
