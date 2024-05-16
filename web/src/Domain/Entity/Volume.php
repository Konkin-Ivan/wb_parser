<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('volume')]
class Volume
{
    #[Id]
    #[Column(name: 'id'), GeneratedValue]
    private int $id;

    #[Column(name: 'volume')]
    private int $volume;

    #[OneToMany(targetEntity: Product::class, mappedBy: 'volume', cascade: ["persist", "remove"])]
    private $products;

    #[Column(name: 'created_at')]
    private \DateTime $createdAt;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function addProduct(Product $products): void
    {
        $this->products[] = $products;
    }

    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): void
    {
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