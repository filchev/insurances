<?php

namespace AppBundle\Entity\Driver;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\TariffAbstract;

/**
 * AccidentTariff
 * 
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Driver\AccidentTariffRepository")
 */
class AccidentTariff extends TariffAbstract
{
}
