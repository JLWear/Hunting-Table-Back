<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SpecieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecieRepository::class)]
#[ApiResource]
class Specie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'species')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToOne(mappedBy: 'specie', cascade: ['persist', 'remove'])]
    private ?Kill $huntKill = null;

    #[ORM\ManyToMany(targetEntity: Season::class, mappedBy: 'specie')]
    private Collection $yes;

    #[ORM\OneToOne(mappedBy: 'specie', cascade: ['persist', 'remove'])]
    private ?Quota $quota = null;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getHuntKill(): ?Kill
    {
        return $this->huntKill;
    }

    public function setHuntKill(?Kill $huntKill): static
    {
        // unset the owning side of the relation if necessary
        if ($huntKill === null && $this->huntKill !== null) {
            $this->huntKill->setSpecie(null);
        }

        // set the owning side of the relation if necessary
        if ($huntKill !== null && $huntKill->getSpecie() !== $this) {
            $huntKill->setSpecie($this);
        }

        $this->huntKill = $huntKill;

        return $this;
    }

    /**
     * @return Collection<int, Season>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Season $ye): static
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->addSpecie($this);
        }

        return $this;
    }

    public function removeYe(Season $ye): static
    {
        if ($this->yes->removeElement($ye)) {
            $ye->removeSpecie($this);
        }

        return $this;
    }

    public function getQuota(): ?Quota
    {
        return $this->quota;
    }

    public function setQuota(Quota $quota): static
    {
        // set the owning side of the relation if necessary
        if ($quota->getSpecie() !== $this) {
            $quota->setSpecie($this);
        }

        $this->quota = $quota;

        return $this;
    }
}
