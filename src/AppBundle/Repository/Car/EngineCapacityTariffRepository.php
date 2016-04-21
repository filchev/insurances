<?php

namespace AppBundle\Repository\Car;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Insurer;
use AppBundle\Entity\Car\EngineCapacity;
use Application\Sonata\UserBundle\Entity\User;
/**
 * CarEngineCapacityTariffRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EngineCapacityTariffRepository extends EntityRepository
{
    
    public function getCapacityTariffByInsurerAndCapacity(Insurer $insurer, EngineCapacity $capacity){
        
       return $this->createQueryBuilder('c')
            ->andWhere('c.insurer = :insurer')
            ->andWhere('c.carEngineCapacity = :capacity')
            ->setParameters(array(
                'insurer' => $insurer,
                'capacity' => $capacity
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    public function getTariffsForUser(User $user){
        
        return $this->createQueryBuilder('c')
                ->andWhere('c.insurer in  (:user)')
                ->setParameter('user', array(1,2))
                ->getQuery()
                ->getResult();
    }
    
}