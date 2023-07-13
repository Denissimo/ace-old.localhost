<?php

namespace App\Command;

use App\Entity\Test;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class TestGenerateCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setName('test-generate')
            ->setDescription('Generation test oblects')
            ->addOption(
                'qty',
                null,
                InputOption::VALUE_OPTIONAL,
                'Quantity',
                10
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $qty = $input->getOption('qty');

        for ($i=0; $i<$qty; $i++) {
            $test = new Test();
            $rand = rand(100, 999);
            $userName = str_shuffle('qwerty') . $rand;
            $test->setName($userName)
                ->setNumber($rand);

            $this->entityManager->persist($test);
            $io->writeln('Created test #: ' . $test->getId());
        }
        $this->entityManager->flush();

        $io->success('Done');

        return Command::SUCCESS;
    }
}
