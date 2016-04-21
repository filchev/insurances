<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\InsurancePolicyFile;
use AppBundle\Form\InsurancePolicyFileType;

/**
 * InsurancePolicyFile controller.
 *
 */
class InsurancePolicyFileController extends Controller
{
    /**
     * Lists all InsurancePolicyFile entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $insurancePolicyFiles = $em->getRepository('AppBundle:InsurancePolicyFile')->findAll();

        return $this->render('insurancepolicyfile/index.html.twig', array(
            'insurancePolicyFiles' => $insurancePolicyFiles,
        ));
    }

    /**
     * Creates a new InsurancePolicyFile entity.
     *
     */
    public function newAction(Request $request)
    {
        $insurancePolicyFile = new InsurancePolicyFile();
        $form = $this->createForm('AppBundle\Form\InsurancePolicyFileType', $insurancePolicyFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insurancePolicyFile);
            $em->flush();

            return $this->redirectToRoute('insurancepolicyfile_show', array('id' => $insurancePolicyFile->getId()));
        }

        return $this->render('insurancepolicyfile/new.html.twig', array(
            'insurancePolicyFile' => $insurancePolicyFile,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a InsurancePolicyFile entity.
     *
     */
    public function showAction(InsurancePolicyFile $insurancePolicyFile)
    {
        $deleteForm = $this->createDeleteForm($insurancePolicyFile);

        return $this->render('insurancepolicyfile/show.html.twig', array(
            'insurancePolicyFile' => $insurancePolicyFile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InsurancePolicyFile entity.
     *
     */
    public function editAction(Request $request, InsurancePolicyFile $insurancePolicyFile)
    {
        $deleteForm = $this->createDeleteForm($insurancePolicyFile);
        $editForm = $this->createForm('AppBundle\Form\InsurancePolicyFileType', $insurancePolicyFile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insurancePolicyFile);
            $em->flush();

            return $this->redirectToRoute('insurancepolicyfile_edit', array('id' => $insurancePolicyFile->getId()));
        }

        return $this->render('insurancepolicyfile/edit.html.twig', array(
            'insurancePolicyFile' => $insurancePolicyFile,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InsurancePolicyFile entity.
     *
     */
    public function deleteAction(Request $request, InsurancePolicyFile $insurancePolicyFile)
    {
        $form = $this->createDeleteForm($insurancePolicyFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($insurancePolicyFile);
            $em->flush();
        }

        return $this->redirectToRoute('insurancepolicyfile_index');
    }

    /**
     * Creates a form to delete a InsurancePolicyFile entity.
     *
     * @param InsurancePolicyFile $insurancePolicyFile The InsurancePolicyFile entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InsurancePolicyFile $insurancePolicyFile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('insurancepolicyfile_delete', array('id' => $insurancePolicyFile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
