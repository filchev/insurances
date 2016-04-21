<?php

namespace AppBundle\Utils\InsuranceCalculator;

use AppBundle\Entity\Insurer;
/**
 * Description of InsurancePolicy
 *
 * @author VM5-dev7
 */
class InsurancePolicy
{
    private $insurer;
    
    private $amount;
    
    /**
     * 
     * @return type
     */
    public function getInsurer(){
        
        return $this->insurer;
    }
    
    /**
     * 
     * @param Insurer $insurer
     * @return \AppBundle\Utils\InsuranceCalculator\InsurancePolicy
     */
    public function setInsurer(Insurer $insurer){
        
        $this->insurer = $insurer;
        
        return $this;
    }
    
    /**
     * 
     * @return float
     */
    public function getAmount(){
        
        return $this->amount;
    }
    
    /**
     * 
     * @param Insurer $insurer
     * @return \AppBundle\Utils\InsuranceCalculator\InsurancePolicy
     */
    public function setAmount($amount){
        
        $this->amount = $amount;
        
        return $this;
    }
}
