<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection; 

use Doctrine\ORM\Mapping as ORM;

/**
 * InsurancePolicy
 *
 * @ORM\Table(name="insurers_configurations")
 * @ORM\Entity()
 */
class InsurerConfiguration
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
     * @ORM\ManyToOne(targetEntity="Insurer", inversedBy="configurations")
     * @ORM\JoinColumn(name="insurer_id", referencedColumnName="id")
     */
    private $insurer;
    
    /**
     * @var CategoryAbstract
     *
     * @ORM\ManyToOne(targetEntity="InsurerConfigurationFile")
     * @ORM\JoinColumn(name="category_option_id", referencedColumnName="id")
     */
    private $configuration;

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
     * Set insurer
     *
     * @param \AppBundle\Entity\Insurer $insurer
     * @return InsurerConfiguration
     */
    public function setInsurer(\AppBundle\Entity\Insurer $insurer = null)
    {
        $this->insurer = $insurer;

        return $this;
    }

    /**
     * Get insurer
     *
     * @return \AppBundle\Entity\Insurer 
     */
    public function getInsurer()
    {
        return $this->insurer;
    }

    /**
     * Set configuration
     *
     * @param \AppBundle\Entity\CategoryAbstract $configuration
     * @return InsurerConfiguration
     */
    public function setConfiguration(\AppBundle\Entity\CategoryAbstract $configuration = null)
    {
        $this->configuration = $configuration;

        return $this;
    }

    /**
     * Get configuration
     *
     * @return \AppBundle\Entity\CategoryAbstract 
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }
}
