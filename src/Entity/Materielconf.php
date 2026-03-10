<?php

namespace App\Entity;

use App\Repository\MaterielconfRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterielconfRepository::class)]
class Materielconf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateresa = null;

    #[ORM\ManyToOne(inversedBy: 'materielconfs')]
    private ?Materiel $materiel = null;

    #[ORM\ManyToOne(inversedBy: 'materielconfs')]
    private ?Conf $conf = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateresa(): ?\DateTimeImmutable
    {
        return $this->dateresa;
    }

    public function setDateresa(\DateTimeImmutable $dateresa): static
    {
        $this->dateresa = $dateresa;

        return $this;
    }

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): static
    {
        $this->materiel = $materiel;

        return $this;
    }

    public function getConf(): ?Conf
    {
        return $this->conf;
    }

    public function setConf(?Conf $conf): static
    {
        $this->conf = $conf;

        return $this;
    }
}
