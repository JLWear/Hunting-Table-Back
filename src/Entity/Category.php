<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getCategory', 'getAllCategories'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getCategory', 'getAllCategories'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Specie::class)]
    private Collection $species;

    public function __construct()
    {
        $this->species = new ArrayCollection();
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

    /**
     * @return Collection<int, Specie>
     */
    public function getSpecies(): Collection
    {
        return $this->species;
    }
}
