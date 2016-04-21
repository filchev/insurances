<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Car\RegistrationNumber;
use AppBundle\Entity\Car\Region;
use AppBundle\Entity\Car\EngineCapacity;

/**
 * Car
 *
 */
class Car
{

    /**
     * @var Region $region
     *
     */
    private $region;
    
    /**
     * @var RegistrationNumber
     * 
     */
    private $registrationNumber;
    
    /**
     * @var EngineCapacity
     * 
     */
    private $engineCapacity;   
    
    /**
     * @var Category
     * 
     */
    private $category;
    
    /**
     * @var RightDirection
     * 
     */
    private $rightDirection;
    
    /**
     * Set region
     *
     * @param Region $region
     * @return Car
     */
    public function setRegion(Region $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return Region 
     */
    public function getRegion()
    {
        return $this->region;
    }
    
    /**
     * Set registrationNumber
     *
     * @param RegistrationNumber $registrationNumber
     * @return Car
     */
    public function setRegistrationNumber(RegistrationNumber $registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    /**
     * Get registrationNumber
     *
     * @return RegistrationNumber 
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }
    
    /**
     * Set engineCapacity
     *
     * @param EngineCapacity $ngineCapacity
     * @return EngineCapacity
     */
    public function setEngineCapacity(EngineCapacity $engineCapacity)
    {
        $this->engineCapacity = $engineCapacity;

        return $this;
    }

    /**
     * Get engineCapacity
     *
     * @return EngineCapacity 
     */
    public function getEngineCapacity()
    {
        return $this->engineCapacity;
    }
    
    /**
     * Set carCategory
     *
     * @param Category $category
     * @return Car
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get carCategory
     *
     * @return Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Set rightDirection
     *
     * @param RightDirection $rightDirection
     * @return Car
     */
    public function setRightDirection(RightDirection $rightDirection)
    {
        $this->rightDirection = $rightDirection;

        return $this;
    }

    /**
     * Get rightDirection
     *
     * @return RightDirection 
     */
    public function getRightDirection()
    {
        return $this->rightDirection;
    }
}
