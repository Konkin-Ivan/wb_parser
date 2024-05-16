<?php

namespace App\Application\Repository;

use App\Domain\Entity\Feedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FeedbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feedback::class);
    }

    public function create(int $value): Feedback
    {
        $feedback = new Feedback();
        $feedback->setFeedback($value);

        return $feedback;
    }

    public function save(Feedback $feedback): void
    {
        $this->getEntityManager()->persist($feedback);
        $this->getEntityManager()->flush();
    }

    public function findAll(): array
    {
        return $this->findAll();
    }

    public function findOneBy(array $criteria, array|null $orderBy = null): ?Feedback
    {
        return $this->findOneBy($criteria);
    }
//    private EntityManagerInterface $entityManager;
//
//    public function __construct(EntityManagerInterface $entityManager)
//    {
//        $this->entityManager = $entityManager;
//    }
//    public function create(int $value): Feedback
//    {
//        $feedback = new Feedback();
//        $feedback->setFeedback($value);
//        $feedback->setCreatedAt(new \DateTime());
//        $this->entityManager->persist($feedback);
//        return $feedback;
//    }
}