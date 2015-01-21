<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlayController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $play = $this->get('at21_eboxoffice_play');
        $form = $this->createForm('play', $play);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($play);
            $em->flush();

            return $this->redirect($this->generateUrl('at21_eboxoffice_admin'));
        }

        return $this->render('At21EBoxOfficeBundle:Play:newPlay.html.twig',
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
    public function updateAction($id, $request)
    {
        $play = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Play')
            ->find($id);
        $form = $this->createForm('play', $play);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($play);
            $em->flush();

            return $this->redirect($this->generateUrl('at21_eboxoffice_admin'));
        }

        return $this->render('At21EBoxOfficeBundle:Play:newPlay.html.twig',
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
    public function checkAction($id)
    {
        $play = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Play')
            ->find($id);
        $sessions = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Session')
            ->findSessionsByPlayId($id);
        return $this->render('At21EBoxOfficeBundle:Play:checkPlay.html.twig',
            array(
                'play' => $play,
                'sessions' => $sessions
            )
        );
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $play = $this->getDoctrine()
            ->getManager()
            ->getRepository('At21EBoxOfficeBundle:Play')
            ->find($id);
        $em = $this->getDoctrine()
            ->getManager();
        $em->remove($play);
        $em->flush();
        return $this->redirect($this->generateUrl('at21_eboxoffice_admin'));
    }
}
