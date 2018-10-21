<?php

namespace App\Command;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Nelmio\Alice\Loader\NativeLoader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FixturesCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'app:fixtures';
    private $manager;
    private $encoder;

    public function __construct( EntityManagerInterface $manager, ?string $name = null, UserPasswordEncoderInterface $encoder )
    {
        parent::__construct($name);
        $this->manager = $manager;
        $this->encoder = $encoder;
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
        $loader->getFakerGenerator()/*->seed(1234)*/;
        $objectSet = $loader->loadFile( __DIR__ . '/fixtures.yml');

        foreach ( $objectSet->getObjects() as $object ) {
            $this->manager->persist( $object );
        }

        $this->manager->flush();

        $doctrine = $this->getContainer()->get('doctrine');
        $users = $doctrine->getRepository( User::class )->findAll();

        foreach ( $users as $user )
        {
            $user->setPassword( $this->encoder->encodePassword($user, $user->getPassword()) );
            $this->manager->persist( $user );
        }

        $this->manager->flush();

        $io->success('Vous avez désormais des données dans votre bdd');
    }
}
