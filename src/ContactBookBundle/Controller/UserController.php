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

class UserController extends Controller
{
    /**
     * @Route("/new", name="userNew")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('ContactBookBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('userShow', array('id' => $user->getId()));
        }

        return $this->render('ContactBookBundle:User:new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/show/{id}", name="userShow")
     */
    public function showAction($id)
    {
        $userRepository = $this->getDoctrine()->getRepository('ContactBookBundle:User');
        $user = $userRepository->find($id);

        $phoneRepository = $this->getDoctrine()->getRepository('ContactBookBundle:Phone');
        $phones = $phoneRepository->findByUser($id);

        $mailRepository = $this->getDoctrine()->getRepository('ContactBookBundle:Mail');
        $mails = $mailRepository->findByUser($id);

        $addressRepository = $this->getDoctrine()->getRepository('ContactBookBundle:Address');
        $address = $addressRepository->findByUser($id);

        if (!$user) {
            throw new NotFoundHttpException('Nie znaleziono użytkownika');
        }

        return $this->render('ContactBookBundle:User:show.html.twig', array(
            'user' => $user,
            'phones' => $phones,
            'mails' => $mails,
            'address' => $address,
        ));
    }

    /**
     * @Route("/showAll", name="userShowAll")
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('ContactBookBundle:User')->findAll();

        return $this->render('ContactBookBundle:User:show_all.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @Route("/delete/{id}", name="userDelete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ContactBookBundle:User')->find($id);

        if (!$user) {
            throw new NotFoundHttpException('Nie znaleziono użytkownika');
        }
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('userShowAll');
    }

    /**
     * @Route("/edit/{id}", name="userEdit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {
        $userRepository = $this->getDoctrine()->getRepository('ContactBookBundle:User');
        $user = $userRepository->find($id);

        $phoneRepository = $this->getDoctrine()->getRepository('ContactBookBundle:Phone');
        $phones = $phoneRepository->findByUser($id);

        $mailRepository = $this->getDoctrine()->getRepository('ContactBookBundle:Mail');
        $mails = $mailRepository->findByUser($id);

        $addressRepository = $this->getDoctrine()->getRepository('ContactBookBundle:Address');
        $address = $addressRepository->findByUser($id);


        if (!$user) {
            throw new NotFoundHttpException('Nie znaleziono użytkownika');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $em->persist($user);

            $em->flush();
            return $this->redirectToRoute('userShowAll');
        }

        return $this->render('ContactBookBundle:User:edit.html.twig', array(
            'form' => $form->createView(),
            'phones' => $phones,
            'mails' => $mails,
            'address' => $address,
        ));
    }

}
