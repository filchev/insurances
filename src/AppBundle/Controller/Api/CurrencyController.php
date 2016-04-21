<?php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\TariffAbstract;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Template()
 */
class CurrencyController extends Controller
{

    protected $encoders;
    protected $normalizers;
    protected $serializer;

    public function __construct()
    {
        $this->encoders = array(new JsonEncoder());
        $this->normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }
    
    public function allAction(Request $request)
    {
        $currencies = $this->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:Currency')
        ->findAll();
        
        return new JsonResponse($this->serializer->serialize($currencies,'json'));
    }

    public function getAction(Request $request)
    {
        $session = $this->container->get('session');
        $session->get('activeCurrency');
        
        $response = new JsonResponse();
        $response->setData(array(
            'currency' => $session->get('activeCurrency')
        ));

        return $response;
    }

    public function postAction(Request $request)
    {

        $data = json_decode($request->getContent());

        $currency = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Currency')
                ->find($data->id);

        $session = $this->container->get('session');
        $session->set('activeCurrency', $this->serializer->serialize($currency, 'json'));

        $response = new JsonResponse();
        $response->setData(array(
            'session' => $session->get('activeCurrency')
        ));

        return $response;
    }

}
