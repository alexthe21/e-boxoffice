<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction()
    {
        $plays = $this->getDoctrine()
            ->getRepository('At21EBoxOfficeBundle:Play')
            ->findAll();
        $theatres = $this->getDoctrine()
            ->getRepository('At21EBoxOfficeBundle:Theatre')
            ->findAll();
        return $this->render('At21EBoxOfficeBundle:Admin:index.html.twig',
            array(
                'plays' => $plays,
                'theatres' => $theatres
            )
        );
    }
}
