<?php

namespace App\Entity;

use App\Repository\ConfRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfRepository::class)]
#[ORM\Table(name: 'conf')]
class Conf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'id')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTime $dateConf = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateAjout = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateConf(): ?\DateTime
    {
        return $this->dateConf;
    }

    public function setDateConf(\DateTime $dateConf): static
    {
        $this->dateConf = $dateConf;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeImmutable
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeImmutable $dateAjout): static
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }
}
