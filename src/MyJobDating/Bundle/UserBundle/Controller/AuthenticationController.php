<?php

namespace MyJobDating\Bundle\UserBundle\Controller;

use DateTime;
use MyJobDating\Bundle\UserBundle\Entity\Candidate;
use MyJobDating\Bundle\UserBundle\Entity\Recruiter;
use MyJobDating\Bundle\UserBundle\Entity\User;
use MyJobDating\Bundle\UserBundle\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationController extends Controller
{
    /**
     * @var AuthenticationUtils
     */
    private $authUtils;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(AuthenticationUtils $authUtils, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->authUtils = $authUtils;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loginAction(): Response
    {
        $authorizationChecker = $this->container->get('security.authorization_checker');
        if ($authorizationChecker->isGranted('ROLE_RECRUITER')
            || $authorizationChecker->isGranted('ROLE_CANDIDATE')) {
            return $this->redirectToRoute('myjobdating_core_homepage');
        }

        $error = $this->authUtils->getLastAuthenticationError();

        $lastUsername = $this->authUtils->getLastUsername();

        return $this->render('@MyJobDatingUser/Authentication/login.html.twig', compact('error', 'lastUsername'));
    }

    public function registerAction(Request $request): Response
    {
        $authorizationChecker = $this->container->get('security.authorization_checker');
        if ($authorizationChecker->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('myjobdating_core_homepage');
        }

        $user = new User;
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setRole($request->request->get('user')['accountType'] === 'recruiter' ? User::ROLE_RECRUITER : User::ROLE_CANDIDATE);

            if ($user->getRole() === User::ROLE_CANDIDATE) {
                $candidate = new Candidate;
                $entityManager->persist($candidate);
                $user->setCandidate($candidate);

            } else if ($user->getRole() === User::ROLE_RECRUITER) {
                $recruiter = new Recruiter;
                $entityManager->persist($recruiter);
                $user->setRecruiter($recruiter);
            }

            $user->setCreatedAt(new DateTime);
            $user->setUpdatedAt(new DateTime);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('myjobdating_core_homepage');
        }

        return $this->render('@MyJobDatingUser/Authentication/register.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
