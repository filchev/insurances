<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TariffAbstract;

/**
 * CategoryTariff
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Car\CategoryTariffRepository")
 */
class CategoryTariff extends TariffAbstract
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
