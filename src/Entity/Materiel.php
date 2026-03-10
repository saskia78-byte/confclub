<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterielRepository::class)]
class Materiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Materielconf>
     */
    #[ORM\OneToMany(targetEntity: Materielconf::class, mappedBy: 'materiel')]
    private Collection $materielconfs;

    public function __construct()
    {
        $this->materielconfs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Materielconf>
     */
    public function getMaterielconfs(): Collection
    {
        return $this->materielconfs;
    }

    public function addMaterielconf(Materielconf $materielconf): static
    {
        if (!$this->materielconfs->contains($materielconf)) {
            $this->materielconfs->add($materielconf);
            $materielconf->setMateriel($this);
        }

        return $this;
    }

    public function removeMaterielconf(Materielconf $materielconf): static
    {
        if ($this->materielconfs->removeElement($materielconf)) {
            // set the owning side to null (unless already changed)
            if ($materielconf->getMateriel() === $this) {
                $materielconf->setMateriel(null);
            }
        }

        return $this;
    }
}
