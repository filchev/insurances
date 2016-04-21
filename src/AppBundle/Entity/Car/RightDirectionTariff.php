<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TariffAbstract;

/**
 * RightDirectionTariffTariff
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Car\RightDirectionTariffRepository")
 */
class RightDirectionTariff extends TariffAbstract
{
}
