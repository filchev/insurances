<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\CategoryAbstract;

/**
 * CarRightDirection
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Car\RightDirectionRepository")
 */
class RightDirection extends CategoryAbstract
{

}
