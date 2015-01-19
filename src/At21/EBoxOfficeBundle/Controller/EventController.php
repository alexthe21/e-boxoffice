<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @param integer $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateEventAction($id, $request)
    {
        $event = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Event')
            ->find($id);
        $form = $this->createForm('event', $event);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteEventAction($id)
    {
        $event = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Event')
            ->find($id);
        $em = $this->getDoctrine()
            ->getManager();
        $em->remove($event);
        $em->flush();
        return $this->redirect($this->generateUrl('at21_eboxoffice_admin'));
    }
}
