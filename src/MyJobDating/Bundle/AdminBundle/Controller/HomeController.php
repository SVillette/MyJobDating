<?php

namespace MyJobDating\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('@MyJobDatingAdmin/Home/index.html.twig');
    }
}
