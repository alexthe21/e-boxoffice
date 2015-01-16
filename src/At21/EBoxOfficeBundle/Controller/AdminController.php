<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('At21EBoxOfficeBundle:Admin:index.html.twig');
    }

    public function newEventAction()
    {
        return $this->render('At21EBoxOfficeBundle:Admin:newEvent.html.twig');
    }
}
