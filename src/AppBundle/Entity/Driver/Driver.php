<?php

namespace AppBundle\Entity\Driver;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Driver
 */
class Driver
{

    /**
     * @var string
     * 
     * @Assert\Range(
     *      min = 17,
     *      max = 100,
     *      minMessage = "Минималната възраст е {{ limit }} години",
     *      maxMessage = "Максималната възраст е {{ limit }} години"
     * )
     */
    private $age;
    
    /**
     *
     * @var Experience 
     */
    private $experience;
    
    /**
     *
     * @var Accident 
     */
    private $accident;


    /**
     * Set age
     *
     * @param integer $age
     * @return Driver
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }
    
    /**
     * Get accident
     *
     * @return Accident 
     */
    public function getAccident()
    {
        return $this->accident;
    }
    
    /**
     * Set accident
     *
     * @param integer $accident
     * @return Driver
     */
    public function setAccident(Accident $accident)
    {
        $this->accident = $accident;

        return $this;
    }
    
    /**
     * Get experience
     *
     * @return Experience 
     */
    public function getExperience()
    {
        return $this->experience;
    }
    
    /**
     * Set experience
     *
     * @param integer $experience
     * @return Driver
     */
    public function setExperience(Experience $experience)
    {
        $this->experience = $experience;

        return $this;
    }


}
