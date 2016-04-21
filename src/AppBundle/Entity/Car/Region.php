<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\CategoryAbstract;

/**
 * Region
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Car\RegionRepository")
 */
class Region extends CategoryAbstract
{

}
