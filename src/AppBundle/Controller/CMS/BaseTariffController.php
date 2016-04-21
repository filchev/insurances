<?php

namespace AppBundle\Controller\CMS;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\InsurerBaseTariff;
use Symfony\Component\DomCrawler\Crawler;

class BaseTariffController extends Controller
{
    /**
     * Lists all CarEngineCapacityTariff entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $baseTariffs = $em->getRepository('AppBundle:InsurerBaseTariff')->getBaseTariffsForUser($this->getUser());

        return $this->render('AppBundle:BaseTariff:index.html.twig', array(
            'baseTariffs' => $baseTariffs,
        ));
    }
    
    public function newAction(Request $request)
    {
        $insurerBaseTariff = new InsurerBaseTariff();
        $form = $this->createForm(new \AppBundle\Form\InsurerBaseTariffType($this->getUser()), $insurerBaseTariff);      
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tariffCategories = $form->get('tariffCategories')->getData();
   
            $em = $this->getDoctrine()->getManager();
            $em->persist($insurerBaseTariff);
            $this->persistTariffCategories($insurerBaseTariff, $tariffCategories);
            $em->flush();

            return $this->redirectToRoute('cms-base-tariffs_index');
        }
        
        return $this->render('AppBundle:BaseTariff:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    private function persistTariffCategories(InsurerBaseTariff $baseTariff, $tariffCategories) {
        
        foreach($tariffCategories as $category) {
            
            $baseTariffCategory = new \AppBundle\Entity\InsurerBaseTariffCategory();
            $baseTariffCategory->setCategory($category);
            $baseTariffCategory->setBaseTariff($baseTariff);
            
            $em = $this->getDoctrine()->getManager();     
            $em->persist($baseTariffCategory);
        }

        
    }

}
