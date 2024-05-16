<?php

namespace App\Domain\Entity;

use App\Application\Repository\FeedbackRecordRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: FeedbackRecordRepository::class)]
#[Table(name: 'feedback_records')]
class FeedbackRecord
{
    #[Id]
    #[Column(name: 'id', type: 'integer')]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ManyToOne(targetEntity: Product::class, inversedBy: 'feedbackRecords')]
    #[JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product $product;

    #[Column(name: 'feedback_count', type: 'integer')]
    private int $feedbackCount;

    #[Column(name: 'record_date', type: 'datetime')]
    private \DateTime $recordDate;

    public function __construct() {
        $this->recordDate = new \DateTime();
    }

    // Getters and Setters
    public function getId(): int {
        return $this->id;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function setProduct(Product $product): void {
        $this->product = $product;
    }

    public function getFeedbackCount(): int {
        return $this->feedbackCount;
    }

    public function setFeedbackCount(int $feedbackCount): void {
        $this->feedbackCount = $feedbackCount;
    }

    public function getRecordDate(): \DateTime {
        return $this->recordDate;
    }

    public function setRecordDate(\DateTime $recordDate): void {
        $this->recordDate = $recordDate;
    }
}