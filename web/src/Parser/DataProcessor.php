<?php

namespace App\Parser;

use App\Entity\Brand;
use App\Entity\Feedbacks;
use App\Entity\Products;
use App\Entity\Volume;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class DataProcessor
{
    private \DateTime $date;
    private Volume $volume;
    private Brand $brand;
    private Products $products;
    private Feedbacks $feedback;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->date = new \DateTime();
        $this->volume = new Volume();
        $this->brand = new Brand();
        $this->products = new Products();
        $this->feedback = new Feedbacks();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function processData(array $dataArray): void
    {
        $brand = $this->brand;
        $products = $this->products;
        $volume = $this->volume;
        $feedback = $this->feedback;

        try {
            $batchSize = 20;
            $count = 0;

            $this->entityManager->beginTransaction();

            foreach ($dataArray['data']['products'] as $item) {

                $volume->setVolume($item['volume']);
                $volume->setCreatedAt($this->date);

                $existingBrand = $this->entityManager->find(Brand::class, 1);

                if ($existingBrand->getName() !== $item['brand']) {
                    $brand->setName($item['brand']);
                    $brand->setCreatedAt($this->date);
                }

                $feedback->setFeedback($item['feedbacks']);
                $feedback->setCreatedAt($this->date);

                $brand = $this->entityManager->find(Brand::class, id: 1);
                $feedback = $this->entityManager->find(Feedbacks::class, id: 1);
                $volume = $this->entityManager->find(Volume::class, id: 1);

                $products->setProductName($item['name']);
                $products->setBrand($brand);
                $products->setFeedback($feedback);
                $products->setVolume($volume);
                $products->setCreatedAt($this->date);

                $count++;

                if ($count % $batchSize === 0) {
                    $this->entityManager->flush();
                    $this->entityManager->clear();
                }
            }

            $this->entityManager->flush();
            $this->entityManager->commit();

        } catch (\Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }

        $this->entityManager->persist($products);
        $this->entityManager->flush();
        $this->entityManager->commit();
    }
}