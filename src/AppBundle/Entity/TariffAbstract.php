<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Insurer;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TariffAbstractRepository")
 * @ORM\Table(name="insurers_tariffs")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="category", type="string")
 * @ORM\DiscriminatorMap({
 * "carEngineCapacityTariff" = "AppBundle\Entity\Car\EngineCapacityTariff",
 * "carCategoryTariff" = "AppBundle\Entity\Car\CategoryTariff",  
 * "carRegistrationNumberTariff" = "AppBundle\Entity\Car\RegistrationNumberTariff",
 * "carRegionTariff" = "AppBundle\Entity\Car\RegionTariff",
 * "carRightDirectionTariff" = "AppBundle\Entity\Car\RightDirectionTariff",
 * "driverAgeTariff" = "AppBundle\Entity\Driver\AgeTariff", 
 * "driverAccidentTariff" = "AppBundle\Entity\Driver\AccidentTariff", 
 * "driverExperienceTariff" = "AppBundle\Entity\Driver\ExperienceTariff"
 * })
 */
class TariffAbstract
{
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2)
     */
    private $amount;
    
    /**
     * @var string
     *
     * @ORM\Column(name="range_min", type="integer")
     */
    private $rangeMin;
    
    /**
     * @var string
     *
     * @ORM\Column(name="range_max", type="integer")
     */
    private $rangeMax;
    /**
     * @var bool
     *
     * @ORM\Column(name="is_percent", type="boolean")
     */
    private $isPercent;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_discount", type="boolean")
     */
    private $isDiscount;

    
    /**
     * @var Insurer
     * 
     * @ORM\ManyToOne(targetEntity="Insurer", inversedBy="tariffs")
     * @ORM\JoinColumn(name="insurer_id", referencedColumnName="id")
     */
    private $insurer;
    
    /**
     * @var Insurer
     * 
     * @ORM\ManyToOne(targetEntity="CategoryAbstract")
     * @ORM\JoinColumn(name="category_option_id", referencedColumnName="id");
     */
    private $categoryOption;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return TariffAbstract
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set rangeMin
     *
     * @param integer $rangeMin
     * @return TariffAbstract
     */
    public function setRangeMin($rangeMin)
    {
        $this->rangeMin = $rangeMin;

        return $this;
    }

    /**
     * Get rangeMin
     *
     * @return integer 
     */
    public function getRangeMin()
    {
        return $this->rangeMin;
    }

    /**
     * Set rangeMax
     *
     * @param integer $rangeMax
     * @return TariffAbstract
     */
    public function setRangeMax($rangeMax)
    {
        $this->rangeMax = $rangeMax;

        return $this;
    }

    /**
     * Get rangeMax
     *
     * @return integer 
     */
    public function getRangeMax()
    {
        return $this->rangeMax;
    }

    /**
     * Set isPercent
     *
     * @param boolean $isPercent
     * @return TariffAbstract
     */
    public function setIsPercent($isPercent)
    {
        $this->isPercent = $isPercent;

        return $this;
    }

    /**
     * Get isPercent
     *
     * @return boolean 
     */
    public function getIsPercent()
    {
        return $this->isPercent;
    }

    /**
     * Set isDiscount
     *
     * @param boolean $isDiscount
     * @return TariffAbstract
     */
    public function setIsDiscount($isDiscount)
    {
        $this->isDiscount = $isDiscount;

        return $this;
    }

    /**
     * Get isDiscount
     *
     * @return boolean 
     */
    public function getIsDiscount()
    {
        return $this->isDiscount;
    }

    /**
     * Set insurer
     *
     * @param \AppBundle\Entity\Insurer $insurer
     * @return TariffAbstract
     */
    public function setInsurer(\AppBundle\Entity\Insurer $insurer = null)
    {
        $this->insurer = $insurer;

        return $this;
    }

    /**
     * Get insurer
     *
     * @return \AppBundle\Entity\Insurer 
     */
    public function getInsurer()
    {
        return $this->insurer;
    }

    /**
     * Set categoryOption
     *
     * @param \AppBundle\Entity\CategoryAbstract $categoryOption
     * @return TariffAbstract
     */
    public function setCategoryOption(\AppBundle\Entity\CategoryAbstract $categoryOption = null)
    {
        $this->categoryOption = $categoryOption;

        return $this;
    }

    /**
     * Get categoryOption
     *
     * @return \AppBundle\Entity\CategoryAbstract 
     */
    public function getCategoryOption()
    {
        return $this->categoryOption;
    }
}
