<?php

namespace AppBundle\Command;

use AppBundle\Entity\User;
use AppBundle\Services\LoadGeoreferences;
use AppBundle\Services\LoadServices;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
            $user = new User();
            $user->setUsername('Admin');
            $user->setName('Admin');
            $user->setDocType(1);
            $user->setIdNumber(13);
            $user->setTelephone(13);
            $user->setEmail('admin@deleyes.com');
            $user->setEnabled(true);
            $user->setPlainPassword('Admin123');
            $user->addRole('ROLE_SUPER_ADMIN');
            $this->getContainer()->get('fos_user.user_manager')->updateUser($user);
        }catch (\Exception $e){
            $output->writeln('<comment>Error Loading initial data '.$e->getMessage().'</comment>');
        }
        $output->writeln('<info>Finished :D</info>');
    }

}
