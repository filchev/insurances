<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InsurancePolicyOption
 *
 * @ORM\Table(name="insurance_policies_options")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InsurancePolicyOptionRepository")
 */
class InsurancePolicyOption
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="InsurancePolicy", inversedBy="insuranceOptions")
     * @ORM\JoinColumn(name="insurance_policy_id", referencedColumnName="id")
     */
    private $insurancePolicy;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="CategoryAbstract")
     * @ORM\JoinColumn(name="category_option_id", referencedColumnName="id")
     */
    private $categoryOption;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2)
     */
    private $amount;
    
    public function __toString(){
        return $this->amount;
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
     * Set amount
     *
     * @param string $amount
     * @return InsurancePolicyOption
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

    /**
     * Set insurancePolicy
     *
     * @param \AppBundle\Entity\InsurancePolicy $insurancePolicy
     * @return InsurancePolicyOption
     */
    public function setInsurancePolicy(\AppBundle\Entity\InsurancePolicy $insurancePolicy = null)
    {
        $this->insurancePolicy = $insurancePolicy;

        return $this;
    }

    /**
     * Get insurancePolicy
     *
     * @return \AppBundle\Entity\InsurancePolicy 
     */
    public function getInsurancePolicy()
    {
        return $this->insurancePolicy;
    }

    /**
     * Set categoryOption
     *
     * @param \AppBundle\Entity\CategoryAbstract $categoryOption
     * @return InsurancePolicyOption
     */
    public function setCategoryOption(\AppBundle\Entity\CategoryAbstract $categoryOption = null)
    {
        $this->categoryOption = $categoryOption;

        return $this;
    }

    /**
     * Get categoryOption
     *
     * @return \AppBundle\Entity\CategoryAbstract 
     */
    public function getCategoryOption()
    {
        return $this->categoryOption;
    }
}
