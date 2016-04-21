<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TariffAbstract;

/**
 * RegionTariff
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Car\RegionTariffRepository")
 */
class RegionTariff extends TariffAbstract
{
}
