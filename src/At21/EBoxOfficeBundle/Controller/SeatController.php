<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SeatController extends Controller
{
    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function bookAction($id)
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
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function confirmAndPayAction(Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $seats = $request->request->get('seats');
        foreach($seats as $s){
            $seat = $em->getRepository('At21EBoxOfficeBundle:Seat')->find($s['id']);
            $seat->setIsBusy(1);
            $em->persist($seat);
        }
        $em->flush();

        return new JsonResponse();
    }
}
