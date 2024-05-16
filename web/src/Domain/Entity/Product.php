<?php

namespace App\Domain\Entity;

use App\Application\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: ProductRepository::class)]
#[Table(name: 'products')]
class Product
{
    #[Id]
    #[Column(name: 'id', type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private $id;

    #[Column(name: 'product_name', type: 'string')]
    private $productName;

    #[OneToMany(targetEntity: FeedbackRecord::class, mappedBy: 'product', cascade: ['persist', 'remove'])]
    private Collection $feedbackRecords;

    #[Column(name: 'created_at', type: 'datetime')]
    private \DateTime $createdAt;

    public function __construct() {
        $this->feedbackRecords = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    // Getters and Setters
    public function getId(): int {
        return $this->id;
    }

    public function getProductName(): string {
        return $this->productName;
    }

    public function setProductName(string $productName): void {
        $this->productName = $productName;
    }

    public function getFeedbackRecords(): Collection {
        return $this->feedbackRecords;
    }

    public function addFeedbackRecord(FeedbackRecord $feedbackRecord): void {
        if (!$this->feedbackRecords->contains($feedbackRecord)) {
            $this->feedbackRecords[] = $feedbackRecord;
            $feedbackRecord->setProduct($this);
        }
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}

//#[Entity(repositoryClass: ProductRepository::class)]
//#[Table('products')]
//class Product
//{
//    #[Id]
//    #[Column(name: 'id'), GeneratedValue]
//    private int $id;
//
//    #[Column(name: 'product_name')]
//    private string $productName;
//
//    #[OneToMany(targetEntity: Feedback::class, mappedBy: 'products', cascade: ["persist", "remove"])]
//    private mixed $feedback;
//
//    #[Column(name: 'created_at')]
//    private \DateTime $createdAt;
//
//    public function getId(): int
//    {
//        return $this->id;
//    }
//
//    public function setId(int $id): void
//    {
//        $this->id = $id;
//    }
//
//    public function getProductName(): string
//    {
//        return $this->productName;
//    }
//
//    public function setProductName(string $productName): void
//    {
//        $this->productName = $productName;
//    }
//
//    public function getCreatedAt(): \DateTime
//    {
//        return $this->createdAt;
//    }
//
//    public function setCreatedAt(\DateTime $createdAt): void
//    {
//        $this->createdAt = $createdAt;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getFeedback(): mixed
//    {
//        return $this->feedback;
//    }
//
//    /**
//     * @param mixed $feedback
//     */
//    public function setFeedback(mixed $feedback): void
//    {
//        $this->feedback = $feedback;
//    }
//
//}