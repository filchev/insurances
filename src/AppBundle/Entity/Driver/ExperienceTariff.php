<?php

namespace AppBundle\Entity\Driver;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TariffAbstract;

/**
 * ExperienceTariff
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Driver\ExperienceTariffRepository")
 */
class ExperienceTariff extends TariffAbstract
{
}
