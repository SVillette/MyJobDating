<?php
namespace MyJobDating\Bundle\OfferBundle\Controller;

use MyJobDating\Bundle\OfferBundle\Form\Type\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OfferController extends Controller
{
    public function indexAction()
    {
        $myUsr = $this->get('security.token_storage')->getToken()->getUser();
        $myRecruiter = $myUsr->getRecruiter();

        return $this->render(
            '@MyJobDatingOffer/Default/index.html.twig',
            ["offers" => $myRecruiter->getOffers()]
        );
    }

    public function addAction()
    {
        $myUsr = $this->get('security.token_storage')->getToken()->getUser();
        $myRecruiter = $myUsr->getRecruiter();

        $myForm = $this->createForm(OfferType::class);

        return $this->render(
            '@MyJobDatingOffer/Default/add.html.twig',
            [
                "recruiter" => $myRecruiter
            ]
        );
    }
}