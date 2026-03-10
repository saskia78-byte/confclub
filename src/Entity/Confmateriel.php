<?php

namespace App\Entity;

use App\Repository\ConfmaterielRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfmaterielRepository::class)]
class Confmateriel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $datereservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatereservation(): ?\DateTimeImmutable
    {
        return $this->datereservation;
    }

    public function setDatereservation(\DateTimeImmutable $datereservation): static
    {
        $this->datereservation = $datereservation;

        return $this;
    }
}
