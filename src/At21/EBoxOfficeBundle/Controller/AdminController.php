<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction()
    {
        $events = $this->getDoctrine()
            ->getRepository('At21EBoxOfficeBundle:Event')
            ->findAll();
        $theatres = $this->getDoctrine()
            ->getRepository('At21EBoxOfficeBundle:Theatre')
            ->findAll();
        return $this->render('At21EBoxOfficeBundle:Admin:index.html.twig',
            array(
                'events' => $events,
                'theatres' => $theatres
            )
        );
    }

    public function newEventAction(Request $request)
    {
        $event = $this->get('at21_eboxoffice_event');
        $form = $this->createForm('event', $event);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirect($this->generateUrl('at21_eboxoffice_admin'));
        }

        return $this->render('At21EBoxOfficeBundle:Admin:newEvent.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    public function newTheatreAction(Request $request)
    {
        $theatre = $this->get('at21_eboxoffice_theatre');
        $form = $this->createForm('theatre', $theatre);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($theatre);
            $em->flush();

            return $this->redirect($this->generateUrl('at21_eboxoffice_admin'));
        }

        return $this->render('At21EBoxOfficeBundle:Admin:newTheatre.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
}
