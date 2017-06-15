<?php

namespace ContactBookBundle\Controller;

use ContactBookBundle\Entity\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MailController extends Controller
{
    /**
     * @Route("/newMail", name="newMail")
     */
    public function newMailAction(Request $request)
    {
        $mail = new Mail();
        $form = $this->createForm('ContactBookBundle\Form\MailType', $mail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mail);
            $em->flush();

            return $this->redirectToRoute('userShowAll');
        }

        return $this->render('ContactBookBundle:Mail:new_mail.html.twig', array(
            'mail' => $mail,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/editMail/{id}", name="editMail")
     */
    public function editMailAction(Request $request, $id)
    {
        $mailRepository = $this->getDoctrine()->getRepository('ContactBookBundle:Mail');
        $mail = $mailRepository->find($id);


        $editForm = $this->createForm('ContactBookBundle\Form\MailType', $mail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $mail = $editForm->getData();
            $em->persist($mail);

            $em->flush();
            return $this->redirectToRoute('userShowAll');
        }
        return $this->render('ContactBookBundle:Phone:edit_phone.html.twig', array(
            'form' => $editForm->createView(),
            'mail' => $mail,
        ));
    }

    /**
     * @Route("/deleteMail/{id}", name="deleteMail")
     */
    public function deleteMailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $mail = $em->getRepository('ContactBookBundle:Mail')->find($id);
        $userId = $mail->getUser()->getId();

        if (!$mail) {
            throw new NotFoundHttpException('Nie znaleziono adresu e-mail');
        }

        $em->remove($mail);
        $em->flush();

        return $this->redirectToRoute('userEdit', array('id' => $userId));
    }

}
