<?php

namespace MyJobDating\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function indexAction(): Response
    {
        return $this->render('@MyJobDatingCore/Home/index.html.twig');
    }
}
