<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('products')]
class Products
{
    #[Id]
    #[Column(name: 'id'), GeneratedValue]
    private int $id;

    #[Column(name: 'product_name')]
    private string $productName;

//    #[ManyToOne(targetEntity: Brand::class, cascade: ["persist", "remove"], inversedBy: 'products')]
//    #[JoinColumn(name: 'brand_id', referencedColumnName: 'id')]
//    private Brand $brand;

//    #[ManyToOne(targetEntity: Feedbacks::class, inversedBy: 'products')]
//    #[JoinColumn(name: 'feedback_id', referencedColumnName: 'id')]
//    private Feedbacks $feedback;

    #[OneToMany(targetEntity: Feedbacks::class, mappedBy: 'products', cascade: ["persist", "remove"])]
    private Feedbacks $feedback;

//    #[ManyToOne(targetEntity: Volume::class, cascade: ["persist", "remove"], inversedBy: 'products')]
//    #[JoinColumn(name: 'volume_id', referencedColumnName: 'id')]
//    private Volume $volume;

    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function setBrand(Brand $brand): void
    {
        $brand->addProduct($this);
        $this->brand = $brand;
    }

    public function getFeedback(): Feedbacks
    {
        return $this->feedback;
    }

    public function setFeedback(Feedbacks $feedback): void
    {
        $feedback->addProduct($this);
        $this->feedback = $feedback;
    }

    public function getVolume(): Volume
    {
        return $this->volume;
    }

    public function setVolume(Volume $volume): void
    {
        $volume->addProduct($this);
        $this->volume = $volume;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}