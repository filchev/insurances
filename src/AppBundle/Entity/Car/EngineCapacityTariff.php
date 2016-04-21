<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TariffAbstract;

/**
 * EngineCapacityTariff
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Car\EngineCapacityTariffRepository")
 */
class EngineCapacityTariff extends TariffAbstract
{
    
    /**
     * @ORM\PrePersist
     */
    public function setMinAndMaxRange()
    {
        $this->setRangeMin(0);
        $this->setRangeMax(0);
    }
}
