<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\CategoryAbstract;

/**
 * EngineCapacity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Car\EngineCapacityRepository")
 */
class EngineCapacity extends CategoryAbstract
{

}
