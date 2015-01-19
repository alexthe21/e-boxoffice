<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/01/15
 * Time: 11:54
 */

namespace At21\EBoxOfficeBundle\EventListener;


use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SecurityListener
{
    protected $session;
    protected $router;
    protected $security;
    protected $dispatcher;

    public function __construct(
        Session $session,
        UrlGeneratorInterface $router,
        AuthorizationChecker $authorizationChecker,
        TraceableEventDispatcher $dispatcher
    )
    {
        $this->session = $session;
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
        $this->dispatcher = $dispatcher;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $this->dispatcher->addListener(KernelEvents::RESPONSE, array($this, 'onKernelResponse'));
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $response = new RedirectResponse($this->router->generate('at21_eboxoffice_admin'));
        } elseif ($this->authorizationChecker->isGranted('ROLE_USER')) {
            $response = new RedirectResponse($this->router->generate('at21_eboxoffice_user'));
        } else {
            $response = new RedirectResponse($this->router->generate('at21_eboxoffice_homepage'));
        }

        $event->setResponse($response);
    }
}