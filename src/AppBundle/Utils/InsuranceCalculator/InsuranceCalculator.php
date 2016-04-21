<?php

namespace AppBundle\Utils\InsuranceCalculator;

use AppBundle\Entity\Currency;
use AppBundle\Entity\Insurer;
use AppBundle\Entity\InsurerBaseTariff;
use Doctrine\ORM\EntityManager;
use AppBundle\Utils\InsuranceCalculator\Tariff\Calculator;
use AppBundle\Utils\InsuranceCalculator\InsurancePolicy;
/**
 * @InjectParams
 */
class InsuranceCalculator
{

    protected $em;
    protected $insurers;
    protected $tariffCalculator;
    protected $insurancePolicies;
    protected $currency;

    public function __construct(EntityManager $entityManager)
    {

        $this->em = $entityManager;
        $this->insurancePolicies = [];

    }

    /**
     * 
     * @param array $data
     * @return \AppBundle\Utils\InsuranceCalculator\InsuranceCalculator
     */
    public function prepare(array $data)
    {
        
        $insurers = $this->em->getRepository('AppBundle:Insurer')->findAll();
        $this->setInsurers($insurers)
            ->setCalculator(new Calculator())
            ->getCalculator()
            ->setCategoryOptions($data);

        return $this;
    }
    
    /**
     * 
     * @param InsurancePolicy $insurancePolicy
     * @return \AppBundle\Utils\InsuranceCalculator\InsuranceCalculator
     */
    public function addInsurancePolicies(InsurancePolicy $insurancePolicy)
    {        
        $this->insurancePolicies[] = $insurancePolicy;
        
        return $this;
    }
    
    /**
     * 
     * @return array
     */
    public function getInsurancePolicies()
    {
        return $this->insurancePolicies;
    }
    
    private function sortInsurancePolicies()
    {
        uasort($this->insurancePolicies, function($a, $b) { 
    
            return $a->getAmount() - $b->getAmount();
        });
        
        return $this;
    }
    
    /**
     * 
     * @return AppBundle\Utils\InsuranceCalculator\Tariff\Calculator
     */
    public function getCalculator()
    {
        return $this->tariffCalculator;
    }
    
    public function setCalculator(Calculator $tariffCalculator)
    {
        $this->tariffCalculator = $tariffCalculator;
        
        return $this;
    }
    
    public function setDriverAge($driverAge)
    {

        $this->getCalculator()->setDriverAge($driverAge);
    }

    /**
     * 
     * @return array
     */
    private function getInsurers()
    {

        return $this->insurers;
    }

    /**
     * 
     * @param array $insurers
     */
    private function setInsurers($insurers)
    {

        $this->insurers = $insurers;
        
        return $this;
    }

    /**
     * 
     * Get a list of insurers and the total of their tariffs (base + basic).
     * If an insurer has no $baseTariff compatible with the request of the client,
     * the insurer is not added to this list.
     * 
     * @return array
     */
    public function getCalculatedInsurances()
    {

        foreach ($this->insurers as $insurer) {

            $baseTariff = $this->getBaseTariff($insurer, $this->getCalculator()->getCategoryOptions());
            
            if ($baseTariff) {

                $basicTariffsTotal = $this->getBasicTariffsTotal($baseTariff, $this->getCalculator()->getCategoryOptions());

                $insuranceTotal = $baseTariff->getAmount() + $basicTariffsTotal;
                
                $insurancePolicy = new InsurancePolicy();
                $insurancePolicy
                        ->setInsurer($insurer)
                        ->setAmount($insuranceTotal);

                $this->addInsurancePolicies($insurancePolicy);
            }
        }

        return $this->sortInsurancePolicies()
                ->getInsurancePolicies();
    }
    
    
    private function calculateAmountByCurrency(Currency $currency, $amount)
    {
        return bcmul($currency->getReverseRate(),$amount);
    }

    /**
     * 
     * Get the base tariff for the selected $insurer
     * 
     * @param Insurer $insurer
     * @param array $data
     * @return InsurerBaseTariff
     */
    public function getBaseTariff(Insurer $insurer, array $data)
    {
        
        $baseTariff = $this->em
                ->getRepository('AppBundle:InsurerBaseTariff')
                ->getBaseTariffForInsurer($insurer, $data);

        return $baseTariff;
    }

    /**
     * 
     * Get the total of all basic tariffs, excluding those that are a part of the
     * base tariff calculation!
     * 
     * @param InsurerBaseTariff $baseTariff
     * @param array $categories
     * @return type
     */
    public function getBasicTariffsTotal(InsurerBaseTariff $baseTariff = null, array $categories)
    {

        $tariffTotal = 0;
        
        $ageTariff = $this->getAgeTariff($baseTariff->getInsurer(), $this->getCalculator()->getDriverAge(), $baseTariff->getAmount());
        $filteredCategories = $this->filterCategories($categories, $baseTariff->getTariffCategories());

        $tariffTotal += $ageTariff;

        foreach ($filteredCategories as $categoryOption) {

            $tariff = $this->getSingleTariffByCategoryOption(
                    $baseTariff->getInsurer(), $categoryOption, $baseTariff->getAmount());

            $tariffTotal += $tariff;
        }

        return $tariffTotal;
    }

    /**
     * 
     * get a list of all tariff categories filtered by $categoriesToRemove
     * 
     * @param array $categories
     * @param array $categoriesToRemove
     * @return array
     */
    public function filterCategories(array $categories, \Doctrine\ORM\PersistentCollection $categoriesToRemove = null)
    {

        $filteredCategories = $categories;
         
        foreach ($categoriesToRemove as $category) {
            $foundCategory = array_search($category->getCategory(), $filteredCategories);
           
            if(!is_null($foundCategory) && is_numeric($foundCategory)) {
                unset($filteredCategories[$foundCategory]);
            }

        }

        return $filteredCategories;
    }

    /**
     * 
     * @param Insurer $insurer
     * @param decimal $age
     * @param decimal $baseAmount
     * @return decimal
     */
    public function getAgeTariff(Insurer $insurer, $age, $baseAmount)
    {

        $ageTariff = $this->em
                ->getRepository('AppBundle:Driver\AgeTariff')
                ->getTariffByInsurerAndAge($insurer, $age);

        return ($ageTariff) ? $this->tariffCalculator->evaluateAmount($baseAmount, $ageTariff) : 0;
    }

    /**
     * 
     * @param Insurer $insurer
     * @param CategoryAbstract $categoryOption
     * @param decimal $baseAmount
     * @return decimal
     */
    private function getSingleTariffByCategoryOption(Insurer $insurer, $categoryOption, $baseAmount)
    {

        $tariff = $this->em
                ->getRepository('AppBundle:TariffAbstract')
                ->findOneBy(array(
            'insurer' => $insurer,
            'categoryOption' => $categoryOption
        ));

        return ($tariff) ? $this->tariffCalculator->evaluateAmount($baseAmount, $tariff) : 0;
    }


}
