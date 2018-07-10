<?php

namespace MyJobDating\Bundle\SkillBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{
    public function indexAction(): Response
    {
        return $this->render('@MyJobDatingSkill/Level/index.html.twig');
    }
}
