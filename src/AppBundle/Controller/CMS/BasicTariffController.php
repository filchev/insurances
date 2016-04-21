<?php

namespace AppBundle\Controller\CMS;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\TariffAbstract;

class BasicTariffController extends Controller
{
    /**
     * Lists all CarEngineCapacityTariff entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $basicTariffs = $em->getRepository('AppBundle:TariffAbstract')->getTariffsForUser($this->getUser());
//        $tariffCategories = $em->getRepository('AppBundle:CategoryAbstract')->getTariffCategories();
        
        return $this->render('AppBundle:BasicTariff:index.html.twig', array(
            'basicTariffs' => $basicTariffs,
//            'tariffCategories' => $tariffCategories
        ));
    }
    
    public function newCarEngineCapacityAction(Request $request)
    {
        $carEngineCapacityTariff = new \AppBundle\Entity\CarEngineCapacityTariff();
        $form = $this->createForm(new \AppBundle\Form\CarEngineCapacityTariffType($this->getUser()),$carEngineCapacityTariff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carEngineCapacityTariff);
            $em->flush();

            return $this->redirectToRoute('cms-basic-tariffs_index');
        }
        
        return $this->render('AppBundle:BasicTariff:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    

}
