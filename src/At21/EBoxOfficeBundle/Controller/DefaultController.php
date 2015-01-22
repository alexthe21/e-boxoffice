<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $plays = $this->getDoctrine()
            ->getRepository('At21EBoxOfficeBundle:Play')
            ->findAll();
        return $this->render('At21EBoxOfficeBundle:Default:index.html.twig',
            array(
                'plays' => $plays
            )
        );
    }
}
