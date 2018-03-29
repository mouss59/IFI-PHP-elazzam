<?php

namespace App\Command;

use App\Entity\Tournament;
use Doctrine\Common\Persistence\ManagerRegistry;
use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Output\OutputInterface;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputOption;


class AppCreateTournamentCommand extends Command
{
    private $doctrine;

    protected static $defaultName = 'app:create-tournament';


    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct();

        $this->doctrine = $doctrine;
    }


    protected function configure()
    {
        $this
            ->setDescription('create a tournament')
            ->addArgument('name',InputArgument::REQUIRED,'The tournament name')
            ->addArgument('date',InputArgument::REQUIRED,'The tournament date')
        ;

    }


    protected function execute(InputInterface $input,OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $date = $input->getArgument('date');


        $tournament = new Tournament();
        $tournament->name = $name;
        $tournament->date = new \DateTimeImmutable($date);

        $manager = $this->doctrine->getManager();
        $manager->persist($tournament);
        $manager->flush();

        $output->writeln(sprintf('Name: %s (%s) successfully added.',$name,$date));
        //,$input->getArgument('name')));
        //$output->writeln(sprintf('Date: %s',$input->getArgument('name')));
    }
}