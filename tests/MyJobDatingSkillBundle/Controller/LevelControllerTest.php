<?php

namespace SkillBundle\Tests\Controller;

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

      $this->add($client, $translator);

      $newLevelCount = $levelRepository->count(array());

      $this->assertTrue($newLevelCount - $oldLevelCount === 1);
    }

    public function add(Client $client, TranslatorInterface $translator){

      $crawler = $client->request('GET', '/levels/add');
      $form = $crawler->selectButton($translator->trans('myjobdating.ui.add'))->form(array(
          'level[name]' => 'Test',
          'level[value]' => '1',
      ));

      $client->submit($form);
    }
}
