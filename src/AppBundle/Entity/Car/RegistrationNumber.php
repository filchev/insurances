<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\CategoryAbstract;

/**
 * RegistrationNumber
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Car\RegistrationNumberRepository")
 */
class RegistrationNumber extends CategoryAbstract 
{

}
