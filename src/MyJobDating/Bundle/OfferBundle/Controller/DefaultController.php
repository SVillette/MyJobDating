<?php

namespace OfferBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyJobDatingOfferBundle:Default:index.html.twig');
    }
}
