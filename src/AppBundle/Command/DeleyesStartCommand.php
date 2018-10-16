<?php

namespace AppBundle\Command;

use AppBundle\Services\LoadGeoreferences;
use AppBundle\Services\LoadServices;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;

class DeleyesStartCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('deleyes:start')
            ->setDescription('Load initial data');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Loading initial data </info>');
        try {
            $ls = $this->getContainer()->get(LoadServices::class);
            $ls->load();
            $lg = $this->getContainer()->get(LoadGeoreferences::class);
            $lg->load();
        }catch (\Exception $e){
            $output->writeln('<comment>Error Loading initial data '.$e->getMessage().'</comment>');
        }
        $output->writeln('<info>Finished :D</info>');
    }

}
