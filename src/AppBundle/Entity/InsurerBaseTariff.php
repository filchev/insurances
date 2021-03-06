<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\CategoryAbstract;
use AppBundle\Entity\Insurer;

/**
 * InsurerBaseTariff
 *
 * @ORM\Table(name="insurers_base_tariffs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InsurerBaseTariffRepository")
 */
class InsurerBaseTariff
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
     * @ORM\ManyToOne(targetEntity="Insurer")
     * @ORM\JoinColumn(name="insurer_id", referencedColumnName="id")
     */
    private $insurer;
    
    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2)
     */
    private $amount;
    
    /**
     * @ORM\OneToMany(targetEntity="InsurerBaseTariffCategory", mappedBy="baseTariff", fetch="EAGER")
     */
    private $tariffCategories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tariffCategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return InsurerBaseTariff
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
     * Add tariffCategories
     *
     * @param \AppBundle\Entity\InsurerBaseTariffCategory $tariffCategories
     * @return InsurerBaseTariff
     */
    public function addTariffCategory(\AppBundle\Entity\InsurerBaseTariffCategory $tariffCategories)
    {
        $this->tariffCategories[] = $tariffCategories;

        return $this;
    }

    /**
     * Remove tariffCategories
     *
     * @param \AppBundle\Entity\InsurerBaseTariffCategory $tariffCategories
     */
    public function removeTariffCategory(\AppBundle\Entity\InsurerBaseTariffCategory $tariffCategories)
    {
        $this->tariffCategories->removeElement($tariffCategories);
    }

    /**
     * Get tariffCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTariffCategories()
    {
        return $this->tariffCategories;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return InsurerBaseTariff
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
