<?php

namespace ContactBookBundle\Controller;

use ContactBookBundle\Entity\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/deleteMail", name="deleteMail")
     */
    public function deleteMailAction()
    {
        return $this->render('ContactBookBundle:Mail:delete_mail.html.twig', array(
            // ...
        ));
    }

}
