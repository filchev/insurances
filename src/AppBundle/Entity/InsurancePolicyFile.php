<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Validator\Constraints as AppBundleAssert;

/**
 * InsurancePolicyFile
 *
 * @ORM\Table(name="insurance_policy_files")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InsurancePolicyFileRepository")
 */
class InsurancePolicyFile
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    private $temp;
    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="InsurancePolicy", inversedBy="insuranceFiles")
     * @ORM\JoinColumn(name="insurance_policy_id", referencedColumnName="id")
     */
    private $insurancePolicy;

    /**
     * @var string
     * @ORM\Column(name="filename", type="string", length=128)
     */
    private $filename;
    
    /**
     * 
     * @AppBundleAssert\InvalidFileData
     * @AppBundleAssert\NotAllowedExtension
     * @Assert\File(
     *  maxSize="2048k",
     *  mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     * 
     * )
     */
    private $file;

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
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Get filename.
     *
     * @return strinng
     */
    public function getFilename()
    {
        return $this->filename;
    }
    
     /**
     * Sets filename.
     *
     * @param string $$filename
     */
    public function setFilename($filename)
    {     
        $this->filename = $filename;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {            
        if (null !== $this->getFile()) {
            
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->getClientOriginalExtension();
            $this->setFilename($this->path);
        }
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {

        if (null === $this->getFile()) {
            return;
        }
        
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(),$this->path);

        $this->setFile(null);
    }
    
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }
    
    /**
     * Set insurancePolicy
     *
     * @param \AppBundle\Entity\InsurancePolicy $insurancePolicy
     * @return InsurancePolicyFile
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
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }

}
