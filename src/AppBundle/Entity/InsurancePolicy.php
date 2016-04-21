<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection; 

use Doctrine\ORM\Mapping as ORM;

/**
 * InsurancePolicy
 *
 * @ORM\Table(name="insurance_policies")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InsurancePolicyRepository")
 */
class InsurancePolicy
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
     * @ORM\Column(name="amount_total", type="decimal", precision=10, scale=2)
     */
    private $amountTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="amount_base", type="decimal", precision=10, scale=2)
     */
    private $amountBase;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;
    
    /**
     * @var AppBundleCurrency
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     */
    private $currency;
    
    /**
     * @ORM\OneToMany(targetEntity="InsurancePolicyOption", mappedBy="insurancePolicy")
     */
    private $insuranceOptions;
    
    /**
     * @ORM\OneToMany(targetEntity="InsurancePolicyFile", mappedBy="insurancePolicy" ,cascade={"all"})
     */
    private $insuranceFiles;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->insuranceOptions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->insuranceFiles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set amountTotal
     *
     * @param string $amountTotal
     * @return InsurancePolicy
     */
    public function setAmountTotal($amountTotal)
    {
        $this->amountTotal = $amountTotal;

        return $this;
    }

    /**
     * Get amountTotal
     *
     * @return string 
     */
    public function getAmountTotal()
    {
        return $this->amountTotal;
    }

    /**
     * Set amountBase
     *
     * @param string $amountBase
     * @return InsurancePolicy
     */
    public function setAmountBase($amountBase)
    {
        $this->amountBase = $amountBase;

        return $this;
    }

    /**
     * Get amountBase
     *
     * @return string 
     */
    public function getAmountBase()
    {
        return $this->amountBase;
    }

    /**
     * Set insurer
     *
     * @param \AppBundle\Entity\Insurer $insurer
     * @return InsurancePolicy
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
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     * @return InsurancePolicy
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set currency
     *
     * @param \AppBundle\Entity\Currency $currency
     * @return Contract
     */
    public function setCurrency(\AppBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \AppBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }
    /**
     * Add insuranceOptions
     *
     * @param \AppBundle\Entity\InsurancePolicyOption $insuranceOptions
     * @return InsurancePolicy
     */
    public function addInsuranceOption(\AppBundle\Entity\InsurancePolicyOption $insuranceOptions)
    {
        $this->insuranceOptions[] = $insuranceOptions;

        return $this;
    }

    /**
     * Remove insuranceOptions
     *
     * @param \AppBundle\Entity\InsurancePolicyOption $insuranceOptions
     */
    public function removeInsuranceOption(\AppBundle\Entity\InsurancePolicyOption $insuranceOptions)
    {
        $this->insuranceOptions->removeElement($insuranceOptions);
    }

    /**
     * Get insuranceOptions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInsuranceOptions()
    {
        return $this->insuranceOptions;
    }

    /**
     * Add insuranceFiles
     *
     * @param \AppBundle\Entity\InsurancePolicyFile $insuranceFiles
     * @return InsurancePolicy
     */
    public function addInsuranceFile(\AppBundle\Entity\InsurancePolicyFile $insuranceFiles)
    {
        $this->insuranceFiles[] = $insuranceFiles;

        return $this;
    }

    /**
     * Remove insuranceFiles
     *
     * @param \AppBundle\Entity\InsurancePolicyFile $insuranceFiles
     */
    public function removeInsuranceFile(\AppBundle\Entity\InsurancePolicyFile $insuranceFiles)
    {
        $this->insuranceFiles->removeElement($insuranceFiles);
    }

    /**
     * Get insuranceFiles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInsuranceFiles()
    {
        return $this->insuranceFiles;
    }
}
