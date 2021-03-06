<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 * 
 * @ORM\Table(name="clients")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 */
class Client
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
     * @var string
     * 
     * @ORM\Column(name="names", type="string", length=255) 
     */
    private $names;

    /**
     * @var string
     * 
     * @ORM\Column(name="email", type="string", length=128)
     */
    private $email;

    /**
     * @var string
     * 
     * @ORM\Column(name="mobile_phone", type="string", length=16) 
     */
    private $mobilePhone;

    /**
     * @var \Date
     * 
     * @ORM\Column(name="dob", type="date") 
     */
    private $dob;

    /**
     * @var string
     * 
     * @ORM\Column(name="address_city", type="string", length=128)
     */
    private $addressCity;

    /**
     * @var string
     * 
     * @ORM\Column(name="address_area", type="string", length=128)
     */
    private $addressArea;

    public function __toString(){
        return $this->getNames();
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
     * Set names
     *
     * @param string $names
     * @return Client
     */
    public function setNames($names)
    {
        $this->names = $names;

        return $this;
    }

    /**
     * Get names
     *
     * @return string 
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set mobilePhone
     *
     * @param string $mobilePhone
     * @return Client
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * Get mobilePhone
     *
     * @return string 
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * Set dob
     *
     * @param \Date $dob
     * @return Client
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \Date 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set addressCity
     *
     * @param string $addressCity
     * @return Client
     */
    public function setAddressCity($addressCity)
    {
        $this->addressCity = $addressCity;

        return $this;
    }

    /**
     * Get addressCity
     *
     * @return string 
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * Set addressArea
     *
     * @param string $addressArea
     * @return Client
     */
    public function setAddressArea($addressArea)
    {
        $this->addressArea = $addressArea;

        return $this;
    }

    /**
     * Get addressArea
     *
     * @return string 
     */
    public function getAddressArea()
    {
        return $this->addressArea;
    }
}
