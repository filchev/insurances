<?php

namespace AppBundle\Utils\CurrencyUtils\Provider;

use AppBundle\Entity\CurrencyProvider;

class Bnb extends Provider
{
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        parent::__construct($em);
        $this->setProvider($em->getRepository('AppBundle:CurrencyProvider')->find(1));
    }
    
    public function synchronizeCurrencies()
    {
        $currencies = new \SimpleXMLElement(file_get_contents($this->getUrl()));
        
        foreach($currencies as $currency) {
            
            if($this->checkIfXmlIsValid($currency)) {
                
                $this->updateCurrency($currency);
            }
        }
    }
    
    private function checkIfXmlIsValid(\SimpleXMLElement $xml)
    {
        
        if(!empty((string) $xml->RATE) &&
           !empty((string) $xml->REVERSERATE) &&
           !empty((string) $xml->CODE)) {
            
            if(!is_numeric((string) $xml->RATE)) {
                return false;
            }
            
            return true;
        }
        
        return false;
    }
    
    private function updateCurrency(\SimpleXMLElement $xml)
    {

//        $curr = $this->getEntityManager()->getRepository('AppBundle:Currency')->findOneBy(array(
//            'name' => (string) $xml->CODE
//        ));
//
//        if(!is_null($curr)) {
//
//            $curr->setRate((string) $xml->RATE)
//                ->setReverseRate((string) $xml->REVERSERATE)
//                ->setUpdatedAt(new \DateTime((string) $xml->CURR_DATE));
//            dump($curr);
//            $this->getEntityManager()->persist($curr);
//
//        } else {
            
            $newCurrency = new \AppBundle\Entity\Currency();   
            
            $newCurrency->setRate((string) $xml->RATE)
                    ->setReverseRate((string) $xml->REVERSERATE)
                    ->setName((string) $xml->CODE)
                    ->setUpdatedAt(new \DateTime((string) $xml->CURR_DATE))
                    ->setProvider($this->getProvider());
                    
            
            $this->getEntityManager()->persist($newCurrency);

//        }

        $this->getEntityManager()->flush();
    }

}
