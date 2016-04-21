<?php

namespace AppBundle\Controller\CMS;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Car\EngineCapacityTariff;
use AppBundle\Form\CarEngineCapacityTariffType;

/**
 * CarEngineCapacityTariff controller.
 *
 */
class CarEngineCapacityTariffController extends Controller
{
    /**
     * Lists all CarEngineCapacityTariff entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carEngineCapacityTariffs = $em->getRepository('AppBundle:Car\EngineCapacityTariff')->getTariffsForUser($this->getUser());

        return $this->render('AppBundle:CarEngineCapacityTariff:index.html.twig', array(
            'carEngineCapacityTariffs' => $carEngineCapacityTariffs,
        ));
    }

    /**
     * Creates a new CarEngineCapacityTariff entity.
     *
     */
    public function newAction(Request $request)
    {
        $carEngineCapacityTariff = new EngineCapacityTariff();
        $form = $this->createForm(new CarEngineCapacityTariffType($this->getUser()), $carEngineCapacityTariff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carEngineCapacityTariff);
            $em->flush();

            return $this->redirectToRoute('cms_carenginecapacity_show', array('id' => $carEngineCapacityTariff->getId()));
        }
        
        return $this->render('AppBundle:CarEngineCapacityTariff:new.html.twig', array(
            'carEngineCapacityTariff' => $carEngineCapacityTariff,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CarEngineCapacityTariff entity.
     *
     */
    public function showAction(EngineCapacityTariff $carEngineCapacityTariff)
    {
        $deleteForm = $this->createDeleteForm($carEngineCapacityTariff);

        return $this->render('AppBundle:CarEngineCapacityTariff:show.html.twig', array(
            'carEngineCapacityTariff' => $carEngineCapacityTariff,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CarEngineCapacityTariff entity.
     *
     */
    public function editAction(Request $request, EngineCapacityTariff $carEngineCapacityTariff)
    {
        $deleteForm = $this->createDeleteForm($carEngineCapacityTariff);
        $editForm = $this->createForm(new CarEngineCapacityTariffType($this->getUser()), $carEngineCapacityTariff);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carEngineCapacityTariff);
            $em->flush();

            return $this->redirectToRoute('cms_carenginecapacity_edit', array('id' => $carEngineCapacityTariff->getId()));
        }

        return $this->render('AppBundle:CarEngineCapacityTariff:edit.html.twig', array(
            'carEngineCapacityTariff' => $carEngineCapacityTariff,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CarEngineCapacityTariff entity.
     *
     */
    public function deleteAction(Request $request, EngineCapacityTariff $carEngineCapacityTariff)
    {
        $form = $this->createDeleteForm($carEngineCapacityTariff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carEngineCapacityTariff);
            $em->flush();
        }

        return $this->redirectToRoute('cms_carenginecapacity_index');
    }

    /**
     * Creates a form to delete a CarEngineCapacityTariff entity.
     *
     * @param CarEngineCapacityTariff $carEngineCapacityTariff The CarEngineCapacityTariff entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CarEngineCapacityTariff $carEngineCapacityTariff)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cms_carenginecapacity_delete', array('id' => $carEngineCapacityTariff->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
