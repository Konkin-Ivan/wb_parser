<?php

namespace App\Application\Service;

use App\Domain\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createOrUpdate(string $productName): Product
    {
        $productRepository = $this->entityManager->getRepository(Product::class);
        $product = $productRepository->findOneBy(['productName' => $productName]);

        if (!$product) {
            $product = new Product();
            $product->setProductName($productName);
            $product->setCreatedAt(new \DateTime());

            $this->entityManager->persist($product);
            $this->entityManager->flush();
        }

        return $product;
    }
}

//class ProductService
//{
//    private EntityManagerInterface $entityManager;
//
//    public function __construct(EntityManagerInterface $entityManager)
//    {
//        $this->entityManager = $entityManager;
//    }
//
//    public function create($value): Product
//    {
//        $volume = new Product();
//        $volume->setProductName($value);
//        $volume->setCreatedAt(new \DateTime());
//
//        $this->entityManager->persist($volume);
//        $this->entityManager->flush();
//
//        return $volume;
//    }
//}