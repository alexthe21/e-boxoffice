<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends Controller
{

    /**
     * @param integer $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction($id, Request $request)
    {
        $session = $this->get('at21_eboxoffice_session');
        $play = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Play')
            ->find($id);
        $session->setPlay($play);
        $form = $this->createForm('session', $session);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($session);
            $em->flush();
            $session->initializeSeats();
            $em->persist($session);
            $em->flush();

            return $this->redirect($this->generateUrl('at21_eboxoffice_admin'));
        }

        return $this->render('At21EBoxOfficeBundle:Session:newSession.html.twig',
            array(
                'play' => $play,
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
    public function updateAction($id, $request)
    {
        $session = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Session')
            ->find($id);
        $form = $this->createForm('session', $session);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($session);
            $em->flush();

            return $this->redirect($this->generateUrl('at21_eboxoffice_admin'));
        }

        return $this->render('At21EBoxOfficeBundle:Session:newSession.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param integer $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function checkAction($id)
    {
        $session = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Session')
            ->find($id);
        $theatre = $session->getTheatre();
        $seats = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Seat')
            ->findSeatsBySessionId($id);
        return $this->render('At21EBoxOfficeBundle:Session:checkSession.html.twig',
            array(
                'session' => $session,
                'theatre' => $theatre,
                'seats' => $seats
            )
        );
    }

    /**
     * @param integer $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function refreshAction($id, Request $request)
    {
        $session = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Session')
            ->find($id);
        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($session, 'json');
        return new Response($response);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $session = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Session')
            ->find($id);
        $em = $this->getDoctrine()
            ->getManager();
        $em->remove($session);
        $em->flush();
        return $this->redirect($this->generateUrl('at21_eboxoffice_admin'));
    }
}
