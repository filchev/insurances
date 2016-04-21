<?php

namespace AppBundle\Controller\CMS;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Currency;
use AppBundle\Form\CurrencyType;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Currency controller.
 *
 */
class CurrencyController extends Controller
{
    /**
     * Lists all Currency entities.
     *
     */
    public function indexAction()
    {
        $currencyUtils = $this->container->get('currency_utils');

        $currencyUtils->setProvider(
                new \AppBundle\Utils\CurrencyUtils\Provider\Bnb($this->getDoctrine()->getManager()), 
                $this->get('kernel')->getRootDir()."/../web/Exchange_Rates.xml");
        
        $currencies = $currencyUtils->getCurrencies();
        
        return $this->render('AppBundle:Currency:index.html.twig', array(
            'currencies' => $currencies,
        ));
    }
    
    public function refreshRatesAction()
    {
        $currencyUtils = $this->container->get('currency_utils');
        
        $currencyUtils->setProvider(
                new \AppBundle\Utils\CurrencyUtils\Provider\Bnb($this->getDoctrine()->getManager()), 
                $this->get('kernel')->getRootDir()."/../web/Exchange_Rates.xml");
        
        $currencyUtils->getProvider()->synchronizeCurrencies();
        
        return $this->redirectToRoute('cms_currencies_index');
        
    }
    

    /**
     * Creates a new Currency entity.
     *
     */
    public function newAction(Request $request)
    {
        $currency = new Currency();
        $form = $this->createForm('AppBundle\Form\CurrencyType', $currency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($currency);
            $em->flush();

            return $this->redirectToRoute('cms_currencies_show', array('id' => $currency->getId()));
        }

        return $this->render('AppBundle:Currency:new.html.twig', array(
            'currency' => $currency,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Currency entity.
     *
     */
    public function showAction(Currency $currency)
    {
        $deleteForm = $this->createDeleteForm($currency);

        return $this->render('AppBundle:Currency:show.html.twig', array(
            'currency' => $currency,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Currency entity.
     *
     */
    public function editAction(Request $request, Currency $currency)
    {
        $deleteForm = $this->createDeleteForm($currency);
        $editForm = $this->createForm('AppBundle\Form\CurrencyType', $currency);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($currency);
            $em->flush();

            return $this->redirectToRoute('cms_currencies_edit', array('id' => $currency->getId()));
        }

        return $this->render('AppBundle:Currency:edit.html.twig', array(
            'currency' => $currency,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Currency entity.
     *
     */
    public function deleteAction(Request $request, Currency $currency)
    {
        $form = $this->createDeleteForm($currency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($currency);
            $em->flush();
        }

        return $this->redirectToRoute('cms_currencies_index');
    }

    /**
     * Creates a form to delete a Currency entity.
     *
     * @param Currency $currency The Currency entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Currency $currency)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cms_currencies_delete', array('id' => $currency->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
