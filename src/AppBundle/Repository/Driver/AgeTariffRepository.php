<?php

namespace AppBundle\Repository\Driver;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Driver\AgeTariff;

/**
 * AgeTariffRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AgeTariffRepository extends EntityRepository
{
    
    public function getTariffByInsurerAndAge(\AppBundle\Entity\Insurer $insurer, $age){
        
        return $this->createQueryBuilder('a')
                ->andWhere('a.insurer = :insurer')
                ->andWhere('a INSTANCE OF (:entity)')
                ->andWhere('a.rangeMax <= :age')
                ->setParameters(array(
                    'insurer' => $insurer,
                    'entity' => 'AgeTariff',
                    'age' => $age
                ))
                ->orderBy('a.rangeMax', 'DESC')
                ->getQuery()
                ->setMaxResults(1)
                ->getOneOrNullResult();
        
    }
}
