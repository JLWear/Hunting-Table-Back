<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
#[ApiResource]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\ManyToMany(targetEntity: Specie::class, inversedBy: 'yes')]
    private Collection $specie;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\OneToOne(mappedBy: 'season', cascade: ['persist', 'remove'])]
    private ?Quota $yes = null;

    public function __construct()
    {
        $this->specie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, Specie>
     */
    public function getSpecie(): Collection
    {
        return $this->specie;
    }

    public function addSpecie(Specie $specie): static
    {
        if (!$this->specie->contains($specie)) {
            $this->specie->add($specie);
        }

        return $this;
    }

    public function removeSpecie(Specie $specie): static
    {
        $this->specie->removeElement($specie);

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getYes(): ?Quota
    {
        return $this->yes;
    }

    public function setYes(?Quota $yes): static
    {
        // unset the owning side of the relation if necessary
        if ($yes === null && $this->yes !== null) {
            $this->yes->setSeason(null);
        }

        // set the owning side of the relation if necessary
        if ($yes !== null && $yes->getSeason() !== $this) {
            $yes->setSeason($this);
        }

        $this->yes = $yes;

        return $this;
    }
}
