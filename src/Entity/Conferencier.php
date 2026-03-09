<?php

namespace App\Entity;

use App\Repository\ConferencierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConferencierRepository::class)]
class Conferencier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    /**
     * @var Collection<int, Conf>
     */
    #[ORM\ManyToMany(targetEntity: Conf::class, mappedBy: 'Conferencier')]
    private Collection $confs;

    public function __construct()
    {
        $this->confs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Conf>
     */
    public function getConfs(): Collection
    {
        return $this->confs;
    }

    public function addConf(Conf $conf): static
    {
        if (!$this->confs->contains($conf)) {
            $this->confs->add($conf);
            $conf->addConferencier($this);
        }

        return $this;
    }

    public function removeConf(Conf $conf): static
    {
        if ($this->confs->removeElement($conf)) {
            $conf->removeConferencier($this);
        }

        return $this;
    }
}
