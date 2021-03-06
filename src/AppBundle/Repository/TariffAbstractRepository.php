<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TariffAbstractRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TariffAbstractRepository extends EntityRepository
{
    public function getTariffsForUser(\Sonata\UserBundle\Model\User $user){
        
        $qb = $this->createQueryBuilder('t');
        $entities = $qb
                ->join('t.insurer', 'insurer')
                ->andWhere(
                        '( insurer.user = :user )'
                )
                ->setParameter('user', $user)
                ->orderBy('t.id', 'DESC')
                ->getQuery()
                ->getResult();
        
        return $entities;
    }
    
    public function findCategoyTariffsByCategoryOptionIds(array $categoriesIds, \AppBundle\Entity\Insurer $insurer) {
        
        return $this->createQueryBuilder('t')
                ->andWhere('t.categoryOption  IN (:categoryOption)')
                ->andWhere('t.insurer = :insurer')
                ->setParameters(array(
                    'categoryOption' => $categoriesIds,
                    'insurer' => $insurer
                ))
                ->orderBy('t.id', 'ASC')
                ->getQuery()
                ->getResult();
        
    }
    
}
