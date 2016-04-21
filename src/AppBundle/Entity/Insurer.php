<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Insurer
 * 
 * @ORM\Table(name="insurers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InsurerRepository")
 */
class Insurer
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
     * @ORM\Column(name="title", type="string", length=128)
     */
    private $title;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="image", type="string", length=128, options={"default" : null})
     */
    private $image;

    /**
     * @var Insurer
     * 
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="insurers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @ORM\OneToMany(targetEntity="InsurerConfiguration", mappedBy="insurer" , fetch="EAGER", cascade={"persist"})
     */
    private $configurations;
    
    /**
     * @ORM\OneToMany(targetEntity="TariffAbstract", mappedBy="insurer" , fetch="EAGER", cascade={"persist"})
     */
    private $tariffs;
    
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->configurations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tariffs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Insurer
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Insurer
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Insurer
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add configurations
     *
     * @param \AppBundle\Entity\InsurerConfiguration $configurations
     * @return Insurer
     */
    public function addConfiguration(\AppBundle\Entity\InsurerConfiguration $configurations)
    {
        $this->configurations[] = $configurations;

        return $this;
    }

    /**
     * Remove configurations
     *
     * @param \AppBundle\Entity\InsurerConfiguration $configurations
     */
    public function removeConfiguration(\AppBundle\Entity\InsurerConfiguration $configurations)
    {
        $this->configurations->removeElement($configurations);
    }

    /**
     * Get configurations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConfigurations()
    {
        return $this->configurations;
    }

    /**
     * Add tariffs
     *
     * @param \AppBundle\Entity\TariffAbstract $tariffs
     * @return Insurer
     */
    public function addTariff(\AppBundle\Entity\TariffAbstract $tariffs)
    {
        $this->tariffs[] = $tariffs;

        return $this;
    }

    /**
     * Remove tariffs
     *
     * @param \AppBundle\Entity\TariffAbstract $tariffs
     */
    public function removeTariff(\AppBundle\Entity\TariffAbstract $tariffs)
    {
        $this->tariffs->removeElement($tariffs);
    }

    /**
     * Get tariffs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTariffs()
    {
        return $this->tariffs;
    }
}
