<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('feedbacks')]
class Feedbacks
{
    #[Id]
    #[Column(name: 'id'), GeneratedValue]
    private int $id;

    #[Column(name: 'feedback')]
    private int $feedback;

//    #[OneToMany(targetEntity: Products::class, mappedBy: 'feedback')]
//    private $products;

    #[ManyToOne(targetEntity: Products::class, cascade: ["persist", "remove"], inversedBy: 'feedback')]
    #[JoinColumn(name: 'product_id', referencedColumnName: 'id')]
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

    public function addProduct(Products $products): void
    {
        $this->products[] = $products;
    }

    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getFeedback(): int
    {
        return $this->feedback;
    }

    public function setFeedback(int $feedback): void
    {
        $this->feedback = $feedback;
    }
}