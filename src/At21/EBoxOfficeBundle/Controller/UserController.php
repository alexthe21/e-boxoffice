<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function indexAction()
    {
        $events = $this->getDoctrine()
            ->getRepository('At21EBoxOfficeBundle:Event')
            ->findAll();
        $theatres = $this->getDoctrine()
            ->getRepository('At21EBoxOfficeBundle:Theatre')
            ->findAll();
        return $this->render('At21EBoxOfficeBundle:User:index.html.twig',
            array(
                'events' => $events
            )
        );
    }
}
