<?php

namespace AppBundle\Entity\Car;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\CategoryAbstract;

/**
 * Category
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Car\CategoryRepository")
 */
class Category extends CategoryAbstract
{
    
}
