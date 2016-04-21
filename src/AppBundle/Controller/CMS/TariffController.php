<?php

namespace AppBundle\Controller\CMS;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\TariffAbstract;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class TariffController extends Controller
{
    
    public function newAction(Request $request){
        
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        
        
        $carEngineCapacityTariff = new \AppBundle\Entity\TariffAbstract();
        $categoryOptions = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:CategoryAbstract')
                ->findAll();
        
        $jsonCategories = $serializer->serialize(array(
            array(
            'discriminator' => 'carCategoryTariff',
            'category' => 'МПС - категория'
        ),
            array(
            'discriminator' => 'carEngineCapacity',
            'category' => 'МПС - кубатура'
        ),
            array(
            'discriminator' => 'carRegion',
            'category' => 'МПС - регион'
        )
            ), 'json');
        $jsonOptions = $serializer->serialize($categoryOptions, 'json');

        $form = $this->createForm(new \AppBundle\Form\TariffType($this->getUser()),$carEngineCapacityTariff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($carEngineCapacityTariff);
            $em->flush();

            return $this->redirectToRoute('cms-basic-tariffs_index');
        }
        
        return $this->render('AppBundle:Tariff:new.html.twig', array(
            'form' => $form->createView(),
            'jsonOptions' => $jsonOptions,
            'jsonCategories' => $jsonCategories
        ));
    }
    
    
}
