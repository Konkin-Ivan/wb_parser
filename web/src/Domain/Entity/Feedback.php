<?php

namespace App\Domain\Entity;

use App\Application\Repository\FeedbackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: FeedbackRepository::class)]
#[Table('feedbacks')]
class Feedback
{
    #[Id]
    #[Column(name: 'id'), GeneratedValue]
    private int $id;

    #[Column(name: 'feedback')]
    private int $feedback;

    #[ManyToOne(targetEntity: Product::class, cascade: ["persist", "remove"], inversedBy: 'feedback')]
    #[JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private $products;

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