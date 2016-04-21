<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\CategoryAbstract;
use AppBundle\Entity\Insurer;

/**
 * InsurerBaseTariff
 *
 * @ORM\Table(name="insurers_base_tariffs_categories")
 * @ORM\Entity()
 */
class InsurerBaseTariffCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var Insurer
     * 
     * @ORM\ManyToOne(targetEntity="CategoryAbstract")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    
    /**
     * @var Insurer
     * 
     * @ORM\ManyToOne(targetEntity="InsurerBaseTariff", inversedBy="tariffCategories")
     * @ORM\JoinColumn(name="base_tariff_id", referencedColumnName="id")
     */
    private $baseTariff;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\CategoryAbstract $category
     * @return InsurerBaseTariffCategory
     */
    public function setCategory(\AppBundle\Entity\CategoryAbstract $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\CategoryAbstract 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set baseTariff
     *
     * @param \AppBundle\Entity\InsurerBaseTariff $baseTariff
     * @return InsurerBaseTariffCategory
     */
    public function setBaseTariff(\AppBundle\Entity\InsurerBaseTariff $baseTariff = null)
    {
        $this->baseTariff = $baseTariff;

        return $this;
    }

    /**
     * Get baseTariff
     *
     * @return \AppBundle\Entity\InsurerBaseTariff 
     */
    public function getBaseTariff()
    {
        return $this->baseTariff;
    }
}
