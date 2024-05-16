<?php

namespace App\Application\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;

class UniversalRepository extends EntityRepository
{
    public function findByEntityAndDateRange(Entity $entity, \DateTime $from, \DateTime $to): array
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->where('e.entity = :entity')
            ->andWhere('e.recordDate BETWEEN :from AND :to')
            ->setParameter('entity', $entity)
            ->setParameter('from', $from)
            ->setParameter('to', $to)
            ->orderBy('e.recordDate', 'ASC')
            ->getQuery()
            ->getResult();
    }
}