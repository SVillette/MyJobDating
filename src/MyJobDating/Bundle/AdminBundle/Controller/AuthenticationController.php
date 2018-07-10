<?php

namespace MyJobDating\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationController extends Controller
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(
        AuthenticationUtils $authenticationUtils,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $this->authenticationUtils = $authenticationUtils;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loginAction(): Response
    {
        $authorizationChecker = $this->container->get('security.authorization_checker');
        if ($authorizationChecker->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('myjobdating_admin_homepage');
        }

        $error = $this->authenticationUtils->getLastAuthenticationError();

        $lastUserName = $this->authenticationUtils->getLastUsername();

        return $this->render('@MyJobDatingAdmin/Authentication/login.html.twig', compact('error', 'lastUserName'));
    }
}
