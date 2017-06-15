<?php

namespace ContactBookBundle\Controller;

use ContactBookBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends Controller
{
    /**
     * @Route("/newAddress", name="newAddress")
     */
    public function newAddressAction(Request $request)
    {
        $address = new Address();
        $form = $this->createForm('ContactBookBundle\Form\AddressType', $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            return $this->redirectToRoute('userShowAll');
        }

        return $this->render('ContactBookBundle:Address:new_address.html.twig', array(
            'mail' => $address,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/editAddress/{id}", name="editAddress")
     */
    public function editAddressAction(Request $request, $id)
    {
        $addressRepository = $this->getDoctrine()->getRepository('ContactBookBundle:Address');
        $address = $addressRepository->find($id);


        $editForm = $this->createForm('ContactBookBundle\Form\AddressType', $address);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $address = $editForm->getData();
            $em->persist($address);

            $em->flush();
            return $this->redirectToRoute('userShowAll');
        }
        return $this->render('ContactBookBundle:Phone:edit_phone.html.twig', array(
            'form' => $editForm->createView(),
            'address' => $address,
        ));
    }

    /**
     * @Route("/deleteAddress", name="deleteAddress")
     */
    public function deleteAddressAction()
    {
        return $this->render('ContactBookBundle:Address:delete_address.html.twig', array(
            // ...
        ));
    }

}
