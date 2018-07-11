<?php

namespace MyJobDating\Bundle\AdminBundle\Command;

use DateTime;
use MyJobDating\Bundle\AdminBundle\Entity\Admin;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateAdminCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('myjobdating:admin:create')
            ->setDescription('Add a new Admin user')
            ->setHelp('This command allow you to create a new admin user')
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the admin user')
            ->addArgument('password', InputArgument::REQUIRED, 'The password of the admin user')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManager = $this->getContainer()->get('doctrine')->getManager();
        $passwordEncoder = $this->getContainer()->get('security.password_encoder');
        $email = $input->getArgument('email');
        $plainPassword = $input->getArgument('password');

        $admin = new Admin;
        $admin->setEmail($email);
        $password = $passwordEncoder->encodePassword($admin, $plainPassword);
        $admin->setPassword($password);
        $admin->setCreatedAt(new DateTime);
        $admin->setUpdatedAt(new DateTime);
        $admin->setEnabled(true);

        $entityManager->persist($admin);
        $entityManager->flush();
    }


}
