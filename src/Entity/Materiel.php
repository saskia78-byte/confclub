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

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'materiels')]
    private ?self $confmateriel = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'confmateriel')]
    private Collection $materiels;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
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

    public function getConfmateriel(): ?self
    {
        return $this->confmateriel;
    }

    public function setConfmateriel(?self $confmateriel): static
    {
        $this->confmateriel = $confmateriel;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(self $materiel): static
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels->add($materiel);
            $materiel->setConfmateriel($this);
        }

        return $this;
    }

    public function removeMateriel(self $materiel): static
    {
        if ($this->materiels->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getConfmateriel() === $this) {
                $materiel->setConfmateriel(null);
            }
        }

        return $this;
    }
}
