<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TheatreController extends Controller
{
    public function newAction(Request $request)
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

        return $this->render('At21EBoxOfficeBundle:Theatre:newTheatre.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
}
