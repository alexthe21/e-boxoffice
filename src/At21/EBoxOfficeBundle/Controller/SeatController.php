<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SeatController extends Controller
{
    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function bookSeatAction($id)
    {
        $seat = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Seat')
            ->find($id);
        $seat->setIsBusy(1);
        $em = $this->getDoctrine()
            ->getManager();
        $em->persist($seat);
        $em->flush();
        return $this->render('At21EBoxOfficeBundle:Seat:bookSeat.html.twig',
            array(
                'seats' => $seat
            )
        );
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function confirmAndPaySeatAction($id)
    {
        $seat = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Seat')
            ->find($id);
        $seat->setIsBusy(1);
        $em = $this->getDoctrine()
            ->getManager();
        $em->persist($seat);
        $em->flush();
        return $this->render('At21EBoxOfficeBundle:Seat:bookSeat.html.twig',
            array(
                'seats' => $seat
            )
        );
    }
}
