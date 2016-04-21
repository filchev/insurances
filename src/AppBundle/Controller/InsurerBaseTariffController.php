<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\InsurerBaseTariff;
use AppBundle\Form\InsurerBaseTariffType;

/**
 * InsurerBaseTariff controller.
 *
 */
class InsurerBaseTariffController extends Controller
{
    /**
     * Lists all InsurerBaseTariff entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $insurerBaseTariffs = $em->getRepository('AppBundle:InsurerBaseTariff')->findAll();

        return $this->render('insurerbasetariff/index.html.twig', array(
            'insurerBaseTariffs' => $insurerBaseTariffs,
        ));
    }

    /**
     * Creates a new InsurerBaseTariff entity.
     *
     */
    public function newAction(Request $request)
    {
        $insurerBaseTariff = new InsurerBaseTariff();
        $form = $this->createForm('AppBundle\Form\InsurerBaseTariffType', $insurerBaseTariff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insurerBaseTariff);
            $em->flush();

            return $this->redirectToRoute('insurerbasetariff_show', array('id' => $insurerBaseTariff->getId()));
        }

        return $this->render('insurerbasetariff/new.html.twig', array(
            'insurerBaseTariff' => $insurerBaseTariff,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a InsurerBaseTariff entity.
     *
     */
    public function showAction(InsurerBaseTariff $insurerBaseTariff)
    {
        $deleteForm = $this->createDeleteForm($insurerBaseTariff);

        return $this->render('insurerbasetariff/show.html.twig', array(
            'insurerBaseTariff' => $insurerBaseTariff,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InsurerBaseTariff entity.
     *
     */
    public function editAction(Request $request, InsurerBaseTariff $insurerBaseTariff)
    {
        $deleteForm = $this->createDeleteForm($insurerBaseTariff);
        $editForm = $this->createForm('AppBundle\Form\InsurerBaseTariffType', $insurerBaseTariff);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insurerBaseTariff);
            $em->flush();

            return $this->redirectToRoute('insurerbasetariff_edit', array('id' => $insurerBaseTariff->getId()));
        }

        return $this->render('insurerbasetariff/edit.html.twig', array(
            'insurerBaseTariff' => $insurerBaseTariff,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InsurerBaseTariff entity.
     *
     */
    public function deleteAction(Request $request, InsurerBaseTariff $insurerBaseTariff)
    {
        $form = $this->createDeleteForm($insurerBaseTariff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($insurerBaseTariff);
            $em->flush();
        }

        return $this->redirectToRoute('insurerbasetariff_index');
    }

    /**
     * Creates a form to delete a InsurerBaseTariff entity.
     *
     * @param InsurerBaseTariff $insurerBaseTariff The InsurerBaseTariff entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InsurerBaseTariff $insurerBaseTariff)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('insurerbasetariff_delete', array('id' => $insurerBaseTariff->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
