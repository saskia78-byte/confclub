<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Conf>
     */
    #[ORM\OneToMany(targetEntity: Conf::class, mappedBy: 'theme')]
    private Collection $confs;

    public function __construct()
    {
        $this->confs = new ArrayCollection();
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
            $conf->setTheme($this);
        }

        return $this;
    }

    public function removeConf(Conf $conf): static
    {
        if ($this->confs->removeElement($conf)) {
            // set the owning side to null (unless already changed)
            if ($conf->getTheme() === $this) {
                $conf->setTheme(null);
            }
        }

        return $this;
    }
}
