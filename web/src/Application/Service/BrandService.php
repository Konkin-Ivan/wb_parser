<?php

namespace App\Application\Service;

use App\Domain\Entity\Brand;
use Doctrine\ORM\EntityManagerInterface;

class BrandService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($value): Brand
    {
//        $this->entityManager->beginTransaction();
//        try {
//
//        } catch (\Exception $e) {
//            $this->entityManager->rollback();
//            throw $e;
//        }
        $brand = new Brand();
        $existingBrand = $this->entityManager->find(Brand::class, 19);

        if ($existingBrand->getName() !== $value) {
            $brand->setName($value);
            $brand->setCreatedAt(new \DateTime());

            $this->entityManager->persist($brand);
            $this->entityManager->flush();
            //$this->entityManager->commit();
        }

        return $brand;
    }
}