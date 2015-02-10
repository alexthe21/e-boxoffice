<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;
use PayPal\Exception\PayPalConnectionException;

class SeatController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function allocateAction(Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $seats = $request->request->get('seats');
        $creditCard = $request->request->get('credit-card');
        $entitySeats = array();

        $userId = $this->get('security.token_storage')->getToken()->getUser();
        $user = $em->getRepository('At21EBoxOfficeBundle:User')->find($userId);
        $em->getConnection()->beginTransaction();
        try {
            foreach ($seats as $s){
                $seat = $em->find('At21EBoxOfficeBundle:Seat', $s['id'], LockMode::OPTIMISTIC, $s['version']);
                $seat->setUser($user);
                $entitySeats[] = $seat;
                $em->persist($seat);
            }
            $em->flush();
            $response = $this->get('paypal_rest_paymentcontroller')->payAction($creditCard, $seats);
            $em->getConnection()->commit();
        } catch(OptimisticLockException $e) {
            $em->getConnection()->rollback();
            return new Response($e->getMessage());
        } catch (PayPalConnectionException $ex) {
            $em->getConnection()->rollback();
            return new Response($ex->getMessage(). $ex->getData());
        }
        return new Response($response);
    }
}