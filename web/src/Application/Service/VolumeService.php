<?php

namespace App\Application\Service;

use App\Domain\Entity\Volume;
use Doctrine\ORM\EntityManagerInterface;

class VolumeService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($value): Volume
    {
        $volume = new Volume();
        $volume->setVolume($value);
        $volume->setCreatedAt(new \DateTime());

        $this->entityManager->persist($volume);
        $this->entityManager->flush();

        return $volume;
    }
}