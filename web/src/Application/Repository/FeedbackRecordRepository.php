<?php

namespace App\Application\Repository;

use App\Domain\Entity\Product;
use Doctrine\ORM\EntityRepository;

class FeedbackRecordRepository extends EntityRepository
{
    public function findByProductAndDateRange(Product $product, \DateTime $from, \DateTime $to): array
    {
        $qb = $this->createQueryBuilder('fr');
        return $qb->where('fr.product = :product')
            ->andWhere('fr.recordDate BETWEEN :from AND :to')
            ->setParameter('product', $product)
            ->setParameter('from', $from)
            ->setParameter('to', $to)
            ->orderBy('fr.recordDate', 'ASC')
            ->getQuery()
            ->getResult();
    }
}