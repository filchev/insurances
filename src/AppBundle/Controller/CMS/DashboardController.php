<?php

namespace AppBundle\Controller\CMS;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
   
    public function indexAction(){
        
        $insurancePolicies = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:InsurancePolicy')
                ->findAll();
        
        return $this->render('AppBundle:Dashboard:index.html.twig',array(
           'insurancePolicies' => $insurancePolicies
        ));
    }
    
    
    
}
