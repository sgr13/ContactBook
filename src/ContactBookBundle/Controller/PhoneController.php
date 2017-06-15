<?php

namespace ContactBookBundle\Controller;

use ContactBookBundle\Entity\Address;
use ContactBookBundle\Entity\Mail;
use ContactBookBundle\Entity\Phone;
use ContactBookBundle\Entity\User;
use ContactBookBundle\Form\PhoneType;
use ContactBookBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhoneController extends Controller
{
    /**
     * @Route("/newPhone" , name="newPhone")
     */
    public function newPhoneAction(Request $request)
    {
        $phone = new Phone();
        $form = $this->createForm('ContactBookBundle\Form\PhoneType', $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($phone);
            $em->flush();

            return $this->redirectToRoute('userShowAll');
        }

        return $this->render('ContactBookBundle:Phone:new_phone.html.twig', array(
            'phone' => $phone,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/editPhone/{id}", name="editPhone")
     */
    public function editPhoneAction(Request $request, $id)
    {
        $phoneRepository = $this->getDoctrine()->getRepository('ContactBookBundle:Phone');
        $phone = $phoneRepository->find($id);


        $editForm = $this->createForm('ContactBookBundle\Form\PhoneType', $phone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $phone = $editForm->getData();
            $em->persist($phone);

            $em->flush();
            return $this->redirectToRoute('userShowAll');
        }
        return $this->render('ContactBookBundle:Phone:edit_phone.html.twig', array(
            'form' => $editForm->createView(),
            'phone' => $phone,
        ));
    }

    /**
     * @Route("/deletePhone/{id}", name="deletePhone")
     */
    public function deletePhoneAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $phone = $em->getRepository('ContactBookBundle:Phone')->find($id);
        $userId = $phone->getUser()->getId();

        if (!$phone) {
            throw new NotFoundHttpException('Nie znaleziono numeru telefonu');
        }

        $em->remove($phone);
        $em->flush();

        return $this->redirectToRoute('userEdit', array('id' => $userId));
    }

}
