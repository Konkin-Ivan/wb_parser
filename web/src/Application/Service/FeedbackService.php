<?php

namespace App\Application\Service;

use App\Domain\Entity\Feedback;
use Doctrine\ORM\EntityManagerInterface;

class FeedbackService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(int $value): Feedback
    {
        $feedback = new Feedback();
        $feedback->setFeedback($value);
        $feedback->setCreatedAt(new \DateTime());

        $this->entityManager->persist($feedback);
        $this->entityManager->flush();

        return $feedback;
    }
}