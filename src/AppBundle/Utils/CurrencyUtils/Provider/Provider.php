<?php

namespace AppBundle\Utils\CurrencyUtils\Provider;

abstract class Provider
{
    
    protected $url;
    protected $provider;
    
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function getEntityManager()
    {
        return $this->em;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setUrl($url = "")
    {
        $this->url = $url;
        
        return $this;
    }
    
    public function getProvider()
    {
        return $this->provider;
    }
    
    public function setProvider($provider = "")
    {
        $this->provider = $provider;
        
        return $this;
    }
}
