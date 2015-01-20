<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function indexAction()
    {
        $plays = $this->getDoctrine()
            ->getRepository('At21EBoxOfficeBundle:Play')
            ->findAll();
        return $this->render('At21EBoxOfficeBundle:User:index.html.twig',
            array(
                'plays' => $plays
            )
        );
    }
}
