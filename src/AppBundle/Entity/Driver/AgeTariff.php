<?php

namespace AppBundle\Entity\Driver;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TariffAbstract;

/**
 * AgeTariff
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Driver\AgeTariffRepository")
 */
class AgeTariff extends TariffAbstract
{
}
