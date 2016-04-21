<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Car
;
/**
 * Calculator
 */
class Calculator
{
    
    /**
     *
     * @var Car
     */
    private $car;
    
    /**
     *
     * @var Driver
     */
    private $driver;
    
    /**
     * Get car
     *
     * @return Car
     */
    public function getCar()
    {
        return $this->car;
    }
    
    /**
     * Set carEngineCapacity
     *
     * @param Car $car
     * @return Car
     */
    public function setCar(Car $car = null)
    {
        $this->car = $car;

        return $this;
    }
    
    /**
     * Get driver
     *
     * @return Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }
    
    /**
     * Set driver
     *
     * @param Driver $driver
     * @return Driver
     */
    public function setDriver(Driver $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }



}
