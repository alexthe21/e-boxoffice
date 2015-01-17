<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{

    public function newEventAction(Request $request)
    {
        $event = $this->get('at21_eboxoffice_event');
        $form = $this->createForm('event', $event);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $event->initializeSeats();
            $em->persist($event);
            $em->flush();

            return $this->redirect($this->generateUrl('at21_eboxoffice_admin'));
        }

        return $this->render('At21EBoxOfficeBundle:Event:newEvent.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    public function checkEventAction($id)
    {
        $event = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Event')
            ->find($id);
        $theatre = $event->getTheatre();
        $seats = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Seat')
            ->getEventSeats($id);
        return $this->render('At21EBoxOfficeBundle:Event:checkEvent.html.twig',
            array(
                'theatre' => $theatre,
                'seats' => $seats
            )
        );
    }
}
