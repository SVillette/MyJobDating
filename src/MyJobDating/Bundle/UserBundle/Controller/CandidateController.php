<?php

namespace MyJobDating\Bundle\UserBundle\Controller;

use MyJobDating\Bundle\UserBundle\Entity\Candidate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CandidateController extends Controller
{
    public function showAction(int $id): Response
    {
        $translator = $this->get('translator');

        $candidateRepository = $this->getDoctrine()->getRepository(Candidate::class);
        $candidate = $candidateRepository->find($id);

        if (null === $candidate) {
            $this->get('session')->getFlashBag()->add('error', $translator->trans('myjobdating.message.error.not_found', array(
                '%resource%' => $translator->trans('myjobdating.ui.the_user')
                )
            ));

            return $this->redirectToRoute('myjobdating_core_homepage');
        }

        return $this->render('@MyJobDatingUser/Candidate/show.html.twig', array(
            'candidate' => $candidate
        ));
    }

    public function updateAction(Request $request, int $id): Response
    {

    }
}
