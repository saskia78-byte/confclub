<?php

namespace App\Entity;

use App\Repository\ConfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConfRepository::class)]
#[ORM\Table(name: 'conf')]
class Conf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'id')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 5,
        max: 100,
        )
    ]
    #[Assert\NotBlank(message:'Le titre ne peut pas être vide')]
    private string $titre;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTime $dateConf = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateAjout = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    /**
     * @var Collection<int, Conferencier>
     */
    #[ORM\ManyToMany(targetEntity: Conferencier::class, inversedBy: 'confs')]
    private Collection $Conferencier;

    #[ORM\ManyToOne(inversedBy: 'confs')]
    private ?Theme $theme = null;

    /**
     * @var Collection<int, Materielconf>
     */
    #[ORM\OneToMany(targetEntity: Materielconf::class, mappedBy: 'conf')]
    private Collection $materielconfs;

    public function __construct()
    {
        $this->Conferencier = new ArrayCollection();
        $this->materielconfs = new ArrayCollection();
    }

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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Conferencier>
     */
    public function getConferencier(): Collection
    {
        return $this->Conferencier;
    }

    public function addConferencier(Conferencier $conferencier): static
    {
        if (!$this->Conferencier->contains($conferencier)) {
            $this->Conferencier->add($conferencier);
        }

        return $this;
    }

    public function removeConferencier(Conferencier $conferencier): static
    {
        $this->Conferencier->removeElement($conferencier);

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): static
    {
        $this->theme = $theme;

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
            $materielconf->setConf($this);
        }

        return $this;
    }

    public function removeMaterielconf(Materielconf $materielconf): static
    {
        if ($this->materielconfs->removeElement($materielconf)) {
            // set the owning side to null (unless already changed)
            if ($materielconf->getConf() === $this) {
                $materielconf->setConf(null);
            }
        }

        return $this;
    }
}
