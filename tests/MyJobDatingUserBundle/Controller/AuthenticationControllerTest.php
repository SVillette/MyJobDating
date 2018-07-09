<?php

namespace UserBundle\Tests\Controller;

use MyJobDating\Bundle\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\TranslatorInterface;

class AuthenticationControllerTest extends WebTestCase
{
    public function register(Client $client, TranslatorInterface $translator)
    {
        $crawler = $client->request('GET', '/register');
        $form = $crawler->selectButton($translator->trans('myjobdating.ui.register'))->form(array(
            'user[lastName]' => 'Test',
            'user[firstName]' => 'Test first name',
            'user[email]' => 'email@test.com',
            'user[plainPassword][first]' => 'testpassword123',
            'user[plainPassword][second]' => 'testpassword123',
        ));

        $form->get('user[accountType]')->select('candidate');

        $client->submit($form);
    }

    public function login(Client $client, TranslatorInterface $translator)
    {
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton($translator->trans('myjobdating.ui.connect'))->form(array(
            '_username' => 'email@test.com',
            '_password' => 'testpassword123'
        ));

        $client->submit($form);
    }

    public function testRegister()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $translator = $container->get('translator');
        $userRepository = $container->get('doctrine')->getRepository(User::class);
        $oldUserCount = $userRepository->count(array());

        $this->register($client, $translator);

        $newUserCount = $userRepository->count(array());

        $this->assertTrue($newUserCount - $oldUserCount === 1);

        $this->register($client, $translator);

        $newUserCount = $userRepository->count(array());

        $this->assertTrue($newUserCount - $oldUserCount === 1);
    }

    public function testLogin()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $translator = $container->get('translator');
        $authorizationChecker = $container->get('security.authorization_checker');
        $userRepository = $container->get('doctrine')->getRepository(User::class);

        $this->register($client, $translator);

        $this->login($client, $translator);

        $crawler = $client->followRedirect();

        $this->assertEquals('MyJobDating\Bundle\CoreBundle\Controller\HomeController::indexAction', $client->getRequest()->attributes->get('_controller'));
    }
}
