<?php

namespace AppBundle\Controller\CMS;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Car\CategoryTariff;
use AppBundle\Form\CarCategoryTariffType;

/**
 * CarCategoryTariff controller.
 *
 */
class CarCategoryTariffController extends Controller
{
    /**
     * Lists all CarCategoryTariff entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carCategoryTariffs = $em->getRepository('AppBundle:Car\CategoryTariff')->findAll();

        return $this->render('AppBundle:CarCategoryTariff:index.html.twig', array(
            'carCategoryTariffs' => $carCategoryTariffs,
        ));
    }

    /**
     * Creates a new CarCategoryTariff entity.
     *
     */
    public function newAction(Request $request)
    {
        $carCategoryTariff = new CategoryTariff();
        $form = $this->createForm(new CarCategoryTariffType($this->getUser()), $carCategoryTariff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carCategoryTariff);
            $em->flush();

            return $this->redirectToRoute('cms_carcategory_show', array('id' => $carCategoryTariff->getId()));
        }

        return $this->render('AppBundle:CarCategoryTariff:new.html.twig', array(
            'carCategoryTariff' => $carCategoryTariff,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CarCategoryTariff entity.
     *
     */
    public function showAction(CategoryTariff $carCategoryTariff)
    {
        $deleteForm = $this->createDeleteForm($carCategoryTariff);

        return $this->render('AppBundle:CarCategoryTariff:show.html.twig', array(
            'carCategoryTariff' => $carCategoryTariff,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CarCategoryTariff entity.
     *
     */
    public function editAction(Request $request, CategoryTariff $carCategoryTariff)
    {
        $deleteForm = $this->createDeleteForm($carCategoryTariff);
        $editForm = $this->createForm(new CarCategoryTariffType($this->getUser()), $carCategoryTariff);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carCategoryTariff);
            $em->flush();

            return $this->redirectToRoute('cms_carcategory_edit', array('id' => $carCategoryTariff->getId()));
        }

        return $this->render('AppBundle:CarCategoryTariff:edit.html.twig', array(
            'carCategoryTariff' => $carCategoryTariff,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CarCategoryTariff entity.
     *
     */
    public function deleteAction(Request $request, CategoryTariff $carCategoryTariff)
    {
        $form = $this->createDeleteForm($carCategoryTariff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($carCategoryTariff);
            $em->flush();
        }

        return $this->redirectToRoute('cms_carcategory_index');
    }

    /**
     * Creates a form to delete a CarCategoryTariff entity.
     *
     * @param CarCategoryTariff $carCategoryTariff The CarCategoryTariff entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategoryTariff $carCategoryTariff)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cms_carcategory_delete', array('id' => $carCategoryTariff->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
