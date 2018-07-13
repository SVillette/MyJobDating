<?php

namespace MyJobDating\Bundle\UserBundle\Controller;

use MyJobDating\Bundle\SkillBundle\Entity\Level;
use MyJobDating\Bundle\SkillBundle\Entity\Skill;
use MyJobDating\Bundle\UserBundle\Entity\Candidate;
use MyJobDating\Bundle\UserBundle\Form\Type\CandidateType;
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
        $translator = $this->get('translator');

        $candidateRepository = $this->getDoctrine()->getRepository(Candidate::class);
        $candidate = $candidateRepository->find($id);
        $skillRepository = $this->getDoctrine()->getRepository(Skill::class);
        $skills = $skillRepository->findAll();
        $levelRepository = $this->getDoctrine()->getRepository(Level::class);
        $levels = $levelRepository->findAll();

        if (null === $candidate) {
            $this->get('session')->getFlashBag()->add('error', $translator->trans('myjobdating.message.error.not_found', array(
                    '%resource%' => $translator->trans('myjobdating.ui.the_user')
                )
            ));

            return $this->redirectToRoute('myjobdating_core_homepage');
        }
        if ($request->isMethod('PUT')) {
            $entityManager = $this->getDoctrine()->getManager();

            $candidateRequest = $request->get('candidate');
            $skills = $candidateRequest['skill'];

            $candidate->setDescription($candidateRequest['description']);
            $skillIds = [];
            foreach ($skills as $skill) {
                $skillIds[] = $skill['name'];
            }
            $skills = $skillRepository->findBy(['id' => $skillIds]);
            $candidate->setSkills($skills);

            $entityManager->persist($candidate);
            $entityManager->flush();

            return $this->redirectToRoute('myjobdating_candidate_profile_show', array('id' => $id));
        }

        return $this->render('@MyJobDatingUser/Candidate/update.html.twig', array(
            'candidate' => $candidate,
            'skills' => $skills,
            'levels' => $levels
        ));
    }
}
