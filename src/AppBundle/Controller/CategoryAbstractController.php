<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\CategoryAbstract;
use AppBundle\Entity\CategoryTranslation;
use AppBundle\Form\CategoryAbstractType;

/**
 * CategoryAbstract controller.
 *
 */
class CategoryAbstractController extends Controller
{
    /**
     * Lists all CategoryAbstract entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoryAbstracts = $em->getRepository('AppBundle:CategoryAbstract')->findAll();

        return $this->render('AppBundle:Category:index.html.twig', array(
            'categoryAbstracts' => $categoryAbstracts,
        ));
    }

    /**
     * Creates a new CategoryAbstract entity.
     *
     */
    public function newAction(Request $request)
    {
        $categoryAbstract = new CategoryAbstract();
        
        $languages = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Language')
                ->findAll();

        foreach($languages as $language) {
            
            $categoryAbstract->addTranslation(new CategoryTranslation($language->getLocale(),'title',''));
        }
        
        $form = $this->createForm(new CategoryAbstractType($this->getDoctrine()->getManager()), $categoryAbstract);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $category = $this->get('category_factory')->get($categoryAbstract);            
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('cms_categories_show', array('id' => $category->getId()));
        }

        return $this->render('AppBundle:Category:new.html.twig', array(
            'categoryAbstract' => $categoryAbstract,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CategoryAbstract entity.
     *
     */
    public function showAction(CategoryAbstract $categoryAbstract)
    {
        $deleteForm = $this->createDeleteForm($categoryAbstract);

        return $this->render('AppBundle:Category:show.html.twig', array(
            'categoryAbstract' => $categoryAbstract,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CategoryAbstract entity.
     *
     */
    public function editAction(Request $request, CategoryAbstract $categoryAbstract)
    {
        $deleteForm = $this->createDeleteForm($categoryAbstract);
        $editForm = $this->createForm(new CategoryAbstractType($this->getDoctrine()->getManager()), $categoryAbstract);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoryAbstract);
            $em->flush();

            return $this->redirectToRoute('cms_categories_edit', array('id' => $categoryAbstract->getId()));
        }

        return $this->render('AppBundle:Category:edit.html.twig', array(
            'categoryAbstract' => $categoryAbstract,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CategoryAbstract entity.
     *
     */
    public function deleteAction(Request $request, CategoryAbstract $categoryAbstract)
    {
        $form = $this->createDeleteForm($categoryAbstract);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categoryAbstract);
            $em->flush();
        }

        return $this->redirectToRoute('cms_categories_index');
    }

    /**
     * Creates a form to delete a CategoryAbstract entity.
     *
     * @param CategoryAbstract $categoryAbstract The CategoryAbstract entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategoryAbstract $categoryAbstract)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cms_categories_delete', array('id' => $categoryAbstract->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
