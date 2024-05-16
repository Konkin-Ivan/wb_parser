<?php

namespace App\Infrastructure\Parser;

use App\Application\Service\BrandService;
use App\Application\Service\FeedbackRecordService;
use App\Application\Service\FeedbackService;
use App\Application\Service\ProductService;
use App\Application\Service\VolumeService;
use App\Domain\Entity\Brand;
use App\Domain\Entity\Feedback;
use App\Domain\Entity\FeedbackRecord;
use App\Domain\Entity\Product;
use App\Domain\Entity\Volume;

class DataProcessor
{
    private BrandService $brandService;
    private ProductService $productService;
    private FeedbackService $feedbackService;
    private VolumeService $volumeService;
    private FeedbackRecordService $feedbackRecordService;

    public function __construct(
        VolumeService $volumeService,
        FeedbackService $feedbackService,
        BrandService $brandService,
        ProductService $productService,
        FeedbackRecordService $feedbackRecordService
    )
    {
        $this->volumeService = $volumeService;
        $this->feedbackService = $feedbackService;
        $this->brandService = $brandService;
        $this->productService = $productService;
        $this->feedbackRecordService = $feedbackRecordService;
    }

    public function processData(array $dataArray): void
    {
        foreach ($dataArray['data']['products'] as $item) {

            $this->processItem($item);

        }
    }

    private function processItem(array $item): void
    {
        $product = $this->createAndPersistProduct($item['name']);
        $this->createAndPersistBrand($item['brand']);
        //$this->createAndPersistFeedback($item['feedbacks']);
        $feedbackRecord = $this->createAndPersistFeedbackRecord($item['feedbacks'], $product);
        $this->createAndPersistVolume($item['volume']);
    }
    public function createAndPersistFeedbackRecord(int $feedbackCount, Product $product): FeedbackRecord
    {
        return $this->feedbackRecordService->create($feedbackCount, $product);
    }

    public function createAndPersistProduct(string $name): Product
    {
        return $this->productService->createOrUpdate($name);
    }

    public function createAndPersistBrand(string $brand): Brand
    {
        return $this->brandService->create($brand);
    }

    public function createAndPersistFeedback(int $feedback): Feedback
    {
        return $this->feedbackService->create($feedback);
    }

    public function createAndPersistVolume(string $volume): Volume
    {
        return $this->volumeService->create($volume);
    }
}