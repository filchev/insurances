<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contract
 * 
 * @ORM\Table(name="contracts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContractRepository")
 */
class Contract
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
     * @ORM\ManyToOne(targetEntity="Insurer")
     * @ORM\JoinColumn(name="insurer_id", referencedColumnName="id")
     */
    private $insurer;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;
   
    
    /**
     * @var bool
     */
    private $isPaid;

    
    public function __toString()
    {
        return (string)$this->id;
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
     * @param integer $insurer
     * @return Contract
     */
    public function setInsurer($insurer)
    {
        $this->insurer = $insurer;

        return $this;
    }

    /**
     * Get insurer
     *
     * @return integer 
     */
    public function getInsurer()
    {
        return $this->insurer;
    }

    /**
     * Set client
     *
     * @param integer $client
     * @return Contract
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return integer 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set isPaid
     *
     * @param boolean $isPaid
     * @return Contract
     */
    public function setIsPaid($isPaid)
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    /**
     * Get isPaid
     *
     * @return boolean 
     */
    public function getIsPaid()
    {
        return $this->isPaid;
    }
}
