<?php

namespace AppBundle\Utils\CurrencyUtils;

use Doctrine\ORM\EntityManager;

class CurrencyUtils
{

    protected $em;
    protected $provider;

    public function __construct(EntityManager $entityManager)
    {

        $this->em = $entityManager;
    }

    public function getProvider()
    {
        return $this->provider;
    }
    
    public function setProvider($provider, $url = null)
    {
        $this->provider = $provider;
        
        if($url) {
            
            $this->provider->setUrl($url);
        } 
        
        return $this;
    }

    public function getCurrencies()
    {

        return $this->em
                        ->getRepository('AppBundle:Currency')
                        ->getNewestCurrencies();
        
    }

}
