<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TariffAbstract;

/**
 * EngineCapacityTariff
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Car\EngineCapacityTariffRepository")
 */
class RegistrationNumberTariff extends TariffAbstract
{
}
