<?php

namespace MyJobDating\Bundle\AdminBundle\Controller;

use DateTime;
use MyJobDating\Bundle\AdminBundle\Form\Type\LevelType;
use MyJobDating\Bundle\SkillBundle\Entity\Level;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{
    public function indexAction(): Response
    {
        $levelRepository = $this->getDoctrine()->getRepository(Level::class);
        $levels = $levelRepository->findAll();

        return $this->render('@MyJobDatingAdmin/Level/index.html.twig', array('levels' => $levels));
    }

    public function addAction(Request $request): Response
    {
        $level = new Level;

        $form = $this->createForm(LevelType::class, $level);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $level->setCreatedAt(new DateTime);
            $level->setUpdatedAt(new DateTime);

            $entityManager->persist($level);
            $entityManager->flush();

            return $this->redirectToRoute('myjobdating_admin_levels_index');
        }

        return $this->render('@MyJobDatingAdmin/Level/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function updateAction(Request $request, int $id): Response
    {
        $levelRepository = $this->getDoctrine()->getRepository(Level::class);
        $level = $levelRepository->find($id);

        $form = $this->createForm(LevelType::class, $level, array('method' => 'PUT'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $level->setUpdatedAt(new DateTime);

            $entityManager->persist($level);
            $entityManager->flush();

            return $this->redirectToRoute('myjobdating_admin_levels_index');
        }

        return $this->render('@MyJobDatingAdmin/Level/update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(int $id): Response
    {
        $levelRepository = $this->getDoctrine()->getRepository(Level::class);
        $level = $levelRepository->find($id);

        if (null !== $level) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->remove($level);
            $entityManager->flush();
        }

        return $this->redirectToRoute('myjobdating_admin_levels_index');
    }
}
