<?php

namespace App\Controller\Api;

use App\Application\Service\FeedbackRecordTransformer;
use App\Domain\Entity\FeedbackRecord;
use App\Domain\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class FeedbackApiController extends AbstractController
{
    #[Route('/products/{id}/feedback', name: 'app_api_feedback', methods: ['GET'])]
    public function getFeedbackRecords
    (
        int $id,
        EntityManagerInterface $entityManager,
        FeedbackRecordTransformer $feedbackRecordTransformer
    ): JsonResponse
    {
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        $feedbackRecordRepository = $entityManager->getRepository(FeedbackRecord::class);

        $from = new \DateTime('2023-01-01');
        $to = new \DateTime('2024-05-17');
        $feedbackRecords = $feedbackRecordRepository->findByProductAndDateRange($product, $from, $to);

        $data = $feedbackRecordTransformer->transformFeedbackRecords($feedbackRecords);

        return $this->json($data);
    }
}