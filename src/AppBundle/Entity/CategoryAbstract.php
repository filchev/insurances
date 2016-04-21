<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryAbstractRepository")
 * @ORM\Table(name="categories_options")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({
 * "carEngineCapacity" = "AppBundle\Entity\Car\EngineCapacity",
 * "carCategory" = "AppBundle\Entity\Car\Category",  
 * "carRegistrationNumber" = "AppBundle\Entity\Car\RegistrationNumber",
 * "carRegion" = "AppBundle\Entity\Car\Region",
 * "carRightDirection" = "AppBundle\Entity\Car\RightDirection",
 * "driverAge" = "AppBundle\Entity\Driver\Age", 
 * "driverAccident" = "AppBundle\Entity\Driver\Accident", 
 * "driverExperience" = "AppBundle\Entity\Driver\Experience",
 * "insurerConfigurationFile" = "InsurerConfigurationFile"
 * })
 */
class CategoryAbstract
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
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=128)
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="CategoryGroup")
     * @ORM\JoinColumn(name="category_group", referencedColumnName="id")
     */
    private $category;
    
    /**
     * @ORM\OneToMany(
     *   targetEntity="CategoryTranslation",
     *   mappedBy="object",
     *   cascade={"persist", "remove"}
     * )
     */
    private $translations;
    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function addTranslation(CategoryTranslation $t)
    {
        if (!$this->translations->contains($t)) {
            $this->translations[] = $t;
            $t->setObject($this);
        }
    }
    
    public function __toString()
    {
        return $this->getTitle();
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
     * @return CarEngineCapacity
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
     * Set category
     *
     * @param string $category
     * @return CategoryAbstract
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
