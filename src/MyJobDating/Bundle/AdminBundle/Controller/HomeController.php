<?php

namespace MyJobDating\Bundle\AdminBundle\Controller;

use MyJobDating\Bundle\OfferBundle\Entity\Offer;
use MyJobDating\Bundle\UserBundle\Entity\Candidate;
use MyJobDating\Bundle\UserBundle\Entity\Recruiter;
use MyJobDating\Bundle\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $users = $userRepository->findAll();

        $candidateRepository = $this->getDoctrine()->getRepository(Candidate::class);
        $candidates = $candidateRepository->findAll();

        $recruiterRepository = $this->getDoctrine()->getRepository(Recruiter::class);
        $recruiters = $recruiterRepository->findAll();

        $jobOfferRepository = $this->getDoctrine()->getRepository(Offer::class);
        $jobOffers = $jobOfferRepository->findAll();

        return $this->render('@MyJobDatingAdmin/Home/index.html.twig', array(
            'users' => $users,
            'candidates' => $candidates,
            'recruiters' => $recruiters,
            'jobOffers' => $jobOffers
        ));
    }
}
