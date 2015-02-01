<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;

class SeatController extends Controller
{

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function confirmAndPayAction(Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $seats = $request->request->get('seats');
        $userId = $request->request->get('userId');
        $amount = 0;
        try {
            $user = $em->getRepository('At21EBoxOfficeBundle:User')->find($userId);
            foreach ($seats as $seat){
                $entity = $em->find('At21EBoxOfficeBundle:Seat', $seat['id'], LockMode::OPTIMISTIC, $seat['version']);
                $entity->setUser($user);
                $em->persist($entity);
                $amount += intval($seat['price']);
            }
            $em->flush();
            $message = 'Purchase Confirmed!';
        } catch(OptimisticLockException $e) {
            $message = "Sorry, somebody already bought some of the seats you were trying to buy!";
        }
        foreach($seats as $s){
            $seat = $em->getRepository('At21EBoxOfficeBundle:Seat')->find($s['id']);
            $seat->setIsBusy(1);
            $em->persist($seat);
        }
        $em->flush();

        return new Response($message);
    }
}
