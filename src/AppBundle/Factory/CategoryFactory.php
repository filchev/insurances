<?php

namespace AppBundle\Factory;

use AppBundle\Entity\CategoryAbstract;
use AppBundle\Entity\Car\RightDirection;
use AppBundle\Entity\Car\EngineCapacity;
use AppBundle\Entity\Car\Region;
use AppBundle\Entity\Car\RegistrationNumber;

class CategoryFactory
{
    public function get(CategoryAbstract $category)
    {
        
        $categoryInstance = null;
        
        switch($category->getCategory()->getId()){
            case 1:
                $categoryInstance = new EngineCapacity();
                break;
            case 2:
                $categoryInstance = new RightDirection();
                break;
            case 3:
                $categoryInstance = new RegistrationNumber;
                break;
            case 4:
                $categoryInstance = new Region();
                break;
            default:
               throw new \DomainException('Wrong parameter!');
           
        }
        
        $categoryInstance->setCategory($category->getCategory());
        $categoryInstance->setTitle($category->getTitle());

        foreach($category->getTranslations() as $translation) {
            $categoryInstance->addTranslation($translation);
        }
        
        return $categoryInstance;
    }
}
