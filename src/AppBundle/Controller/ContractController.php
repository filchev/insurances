<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Contract;
use AppBundle\Form\ContractCalculatorType;

/**
 * Contract controller.
 *
 */
class ContractController extends Controller
{
    /**
     * Lists all Contract entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contracts = $em->getRepository('AppBundle:Contract')->findAll();

        return $this->render('AppBundle:Contract:index.html.twig', array(
            'contracts' => $contracts
        ));
    }

    

    /**
     * Creates a new Contract entity.
     *
     */
    public function newAction(Request $request)
    {
        $contract = new Contract();
        $form = $this->createForm('AppBundle\Form\ContractType', $contract);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contract);
            $em->flush();

            return $this->redirectToRoute('contracts_show', array('id' => $contract->getId()));
        }

        return $this->render('AppBundle:Contract:new.html.twig', array(
            'contract' => $contract,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Contract entity.
     *
     */
    public function showAction(Contract $contract)
    {
        $deleteForm = $this->createDeleteForm($contract);

        return $this->render('AppBundle:Contract:show.html.twig', array(
            'contract' => $contract,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contract entity.
     *
     */
    public function editAction(Request $request, Contract $contract)
    {
        $deleteForm = $this->createDeleteForm($contract);
        $editForm = $this->createForm('AppBundle\Form\ContractType', $contract);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contract);
            $em->flush();

            return $this->redirectToRoute('contracts_edit', array('id' => $contract->getId()));
        }

        return $this->render('AppBundle:Contract:edit.html.twig', array(
            'contract' => $contract,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contract entity.
     *
     */
    public function deleteAction(Request $request, Contract $contract)
    {
        $form = $this->createDeleteForm($contract);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contract);
            $em->flush();
        }

        return $this->redirectToRoute('contracts_index');
    }

    /**
     * Creates a form to delete a Contract entity.
     *
     * @param Contract $contract The Contract entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contract $contract)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contracts_delete', array('id' => $contract->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
