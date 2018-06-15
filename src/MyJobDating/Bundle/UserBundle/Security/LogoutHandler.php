<?php

namespace MyJobDating\Bundle\UserBundle\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Translation\TranslatorInterface;

class LogoutHandler implements LogoutSuccessHandlerInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(TranslatorInterface $translator, UrlGeneratorInterface $urlGenerator)
    {
        $this->translator = $translator;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function onLogoutSuccess(Request $request)
    {
        $request->getSession()->getBag('flashes')->add('info', $this->translator->trans('myjobdating.ui.you_have_been_logout'));
        return new RedirectResponse($this->urlGenerator->generate('myjobdating_core_homepage'));
    }
}
