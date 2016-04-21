<?php

namespace AppBundle\Entity\Driver;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\CategoryAbstract;

/**
 * Experience
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Driver\ExperienceRepository")
 */
class Experience extends CategoryAbstract
{

}
