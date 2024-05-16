<?php

namespace App\Application\Repository;

use App\Domain\Entity\Brand;
use Doctrine\ORM\EntityManagerInterface;

class BrandRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function create($value): Brand
    {
        $brand = new Brand();
        $existingBrand = $this->entityManager->find(Brand::class, 19);

        if ($existingBrand->getName() !== $value) {
            $brand->setName($value);
            $brand->setCreatedAt(new \DateTime());
            $this->entityManager->persist($brand);
        }
        return $brand;
    }
}