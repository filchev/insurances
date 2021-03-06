<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CurrencyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CurrencyRepository extends EntityRepository
{
    
    public function getNewestCurrencies()
    {
        
        $maxCurrencies = $this->_em->createQueryBuilder()
                ->addSelect('MAX(tc.id)')
                ->from('AppBundle:Currency','tc')
                ->groupBy('tc.name')
                ->getDQL();
     
        return $this->createQueryBuilder('c')
                ->where("c.id IN ($maxCurrencies)")
                ->getQuery()
                ->getResult();
        
    }
    
}
