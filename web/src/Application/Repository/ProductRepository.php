<?php

namespace App\Application\Repository;

use App\Domain\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    private mixed $_em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function create($value): Product
    {
        $product = new Product();
        $product->setProductName($value);
        $product->setCreatedAt(new \DateTime());

        $this->_em->persist($product);
        $this->_em->flush();

        return $product;
    }
}