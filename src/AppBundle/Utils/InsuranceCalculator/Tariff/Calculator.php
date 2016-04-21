<?php

namespace AppBundle\Utils\InsuranceCalculator\Tariff;

use Doctrine\ORM\EntityManager;
/**
 * Description of Calculation
 *
 * @author VM5-dev7
 */
class Calculator
{
    protected $categoryOptions;
    protected $driverAge;
    
    public function __construct()
    {
        $this->categoryOptions = [];
    }
    
    public function getCategoryOptions()
    {
        return $this->categoryOptions;
    }
    
    public function addCategoryOptions($categoryOptions)
    {
        $this->categoryOptions[] = $categoryOptions;
        
        return $this;
    }
    
        public function setDriverAge($age)
    {

        $this->driverAge = $age;

        return $this;
    }

    /**
     * 
     * @return integer
     */
    public function getDriverAge()
    {
        return $this->driverAge;
    }
    
    public function setCategoryOptions(array $categoryOptions)
    {
        $this->categoryOptions[] = $categoryOptions['car']->getRegistrationNumber();
        $this->categoryOptions[] = $categoryOptions['car']->getEngineCapacity();
        $this->categoryOptions[] = $categoryOptions['car']->getRightDirection();
        $this->categoryOptions[] = $categoryOptions['car']->getRegion();
        $this->categoryOptions[] = $categoryOptions['car']->getCategory();
        $this->categoryOptions[] = $categoryOptions['driver']->getAccident();
        $this->categoryOptions[] = $categoryOptions['driver']->getExperience();
        
        $this->driverAge = $categoryOptions['driver']->getAge();
        
        return $this;
    }
    
    /**
     * 
     * Check wether the tariff is percent and if it is, multiply it by the base amount
     * and derive by 100. After that check wether the tariff is discount, and if it is
     * add negative value to it.
     * 
     * @param float $baseAmount
     * @param \AppBundle\Entity\TariffAbstract $tariff
     * @return float
     */
    public function evaluateAmount($baseAmount, \AppBundle\Entity\TariffAbstract $tariff)
    {

        $evaulatedAmount = 0;
        
        if($tariff->getIsPercent()) {
            $evaulatedAmount = $this->getPercentValue($baseAmount, $tariff->getAmount(), 2);
        } else {
            $evaulatedAmount = $tariff->getAmount();
        }
        
        if($tariff->getIsDiscount()) {
            $evaulatedAmount = -abs($evaulatedAmount);
        }


        return $evaulatedAmount;
    }
    
    /**
     * 
     * @param float $baseAmount
     * @param float $tariff
     * @param integer $precision
     * @return float
     */
    private function getPercentValue($baseAmount, $tariff, $precision)
    {

        $tempAmount = bcmul($baseAmount, $tariff, $precision);
        $percentAmount = bcdiv($tempAmount, 100, $precision);
        
        return $percentAmount;
    }
}
