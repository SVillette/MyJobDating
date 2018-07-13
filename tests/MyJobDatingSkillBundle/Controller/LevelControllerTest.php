<?php

namespace SkillBundle\Tests\Controller;

use MyJobDating\Bundle\AdminBundle\Entity\Admin;
use MyJobDating\Bundle\SkillBundle\Entity\Level;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\TranslatorInterface;

class LevelControllerTest extends WebTestCase
{
    public function testIndex()
    {

    }

    public function testAdd()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $translator = $container->get('translator');
        $levelRepository = $container->get('doctrine')->getRepository(Level::class);
        $oldLevelCount = $levelRepository->count(array());
        $this->registerAdmin($client);
        $this->login($client, $translator);
        $client->followRedirect(true);
        $this->add($client, $translator);

        $newLevelCount = $levelRepository->count(array());

        $this->assertTrue($newLevelCount - $oldLevelCount === 1);
    }

    public function add(Client $client, TranslatorInterface $translator)
    {

        $crawler = $client->request('GET', '/admin/levels/add');
        $form = $crawler->selectButton($translator->trans('myjobdating.ui.add'))->form(array(
            'level[name]' => 'Test',
            'level[value]' => '1',
        ));

        $client->submit($form);
    }

    public function testDelete()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $translator = $container->get('translator');
        $levelRepository = $container->get('doctrine')->getRepository(Level::class);
        $levels = $levelRepository->findAll();

        //$this->registerAdmin($client);
        $this->login($client, $translator);
        $this->add($client, $translator);
        $oldLevelCount = $levelRepository->count(array());
        $this->delete($client, $translator, $levels[0]->getId());

        $newLevelCount = $levelRepository->count(array());

        $this->assertTrue($newLevelCount !== $oldLevelCount);
    }

    public function delete(Client $client, TranslatorInterface $translator, $id)
    {

        $crawler = $client->request('DELETE', '/admin/levels/' . $id . '/delete');

    }

    public function registerAdmin(Client $client)
    {
        $container = $client->getContainer();
        $entityManager = $container->get('doctrine')->getManager();
        $passwordEncoder = $container->get('security.password_encoder');
        $admin = new Admin;
        $admin->setEmail('superadmin@mail.com');
        $admin->setPlainPassword("superadmin");
        $password = $passwordEncoder->encodePassword($admin, $admin->getPlainPassword());
        $admin->setPassword($password);
        $entityManager->persist($admin);
        $entityManager->flush();
    }

    public function login(Client $client, TranslatorInterface $translator)
    {
        $crawler = $client->request('GET', '/admin/login');
        $form = $crawler->selectButton($translator->trans('myjobdating.ui.connect'))->form(array(
            '_username' => 'superadmin@mail.com',
            '_password' => 'superadmin'
        ));

        $client->submit($form);
    }
}
