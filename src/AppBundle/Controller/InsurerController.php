<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Insurer;
use AppBundle\Form\InsurerType;

/**
 * Insurer controller.
 *
 */
class InsurerController extends Controller
{
    /**
     * Lists all Insurer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $insurers = $em->getRepository('AppBundle:Insurer')->findAll();

        return $this->render('AppBundle:Insurer:index.html.twig', array(
            'insurers' => $insurers,
        ));
    }

    /**
     * Creates a new Insurer entity.
     *
     */
    public function newAction(Request $request)
    {
        $insurer = new Insurer();
        $form = $this->createForm('AppBundle\Form\InsurerType', $insurer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insurer);
            $em->flush();

            return $this->redirectToRoute('insurers_show', array('id' => $insurer->getId()));
        }

        return $this->render('AppBundle:Insurer:new.html.twig', array(
            'insurer' => $insurer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Insurer entity.
     *
     */
    public function showAction(Insurer $insurer)
    {
        $deleteForm = $this->createDeleteForm($insurer);

        return $this->render('AppBundle:Insurer:show.html.twig', array(
            'insurer' => $insurer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Insurer entity.
     *
     */
    public function editAction(Request $request, Insurer $insurer)
    {
        $deleteForm = $this->createDeleteForm($insurer);
        $editForm = $this->createForm('AppBundle\Form\InsurerType', $insurer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insurer);
            $em->flush();

            return $this->redirectToRoute('insurers_edit', array('id' => $insurer->getId()));
        }

        return $this->render('AppBundle:Insurer:edit.html.twig', array(
            'insurer' => $insurer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Insurer entity.
     *
     */
    public function deleteAction(Request $request, Insurer $insurer)
    {
        $form = $this->createDeleteForm($insurer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($insurer);
            $em->flush();
        }

        return $this->redirectToRoute('insurers_index');
    }

    /**
     * Creates a form to delete a Insurer entity.
     *
     * @param Insurer $insurer The Insurer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Insurer $insurer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('insurers_delete', array('id' => $insurer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
