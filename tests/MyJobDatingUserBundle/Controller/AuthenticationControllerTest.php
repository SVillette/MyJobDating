<?php

namespace UserBundle\Tests\Controller;

use MyJobDating\Bundle\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $translator = $container->get('translator');
        $userRepository = $container->get('doctrine')->getRepository(User::class);
        $oldUserCount = $userRepository->count(array());

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

        $newUserCount = $userRepository->count(array());

        $this->assertTrue($newUserCount - $oldUserCount === 1);
    }
}
