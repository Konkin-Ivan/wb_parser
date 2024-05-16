<?php

namespace App\Application\Service;

use App\Domain\Entity\FeedbackRecord;
use App\Domain\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class FeedbackRecordService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(int $feedbackCount, Product $product): FeedbackRecord
    {
        $feedbackRecord = new FeedbackRecord();
        $feedbackRecord->setFeedbackCount($feedbackCount);
        $feedbackRecord->setProduct($product);
        $feedbackRecord->setRecordDate(new \DateTime()); // Устанавливаем текущую дату

        $this->entityManager->persist($feedbackRecord);
        $this->entityManager->flush();

        return $feedbackRecord;
    }

    public function getFeedbacksForProduct(Product $product, \DateTime $from, \DateTime $to): array
    {
        $feedbackRecordRepository = $this->entityManager->getRepository(FeedbackRecord::class);
        return $feedbackRecordRepository->findBy(
            ['product' => $product, 'recordDate' => ['$gte' => $from, '$lte' => $to]],
            ['recordDate' => 'ASC']
        );
    }
}