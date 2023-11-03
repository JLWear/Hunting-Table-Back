<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\FederationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FederationRepository::class)]
#[ApiResource]
class Federation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(inversedBy: 'federation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Department $department = null;

    #[ORM\OneToMany(mappedBy: 'federation', targetEntity: Society::class, orphanRemoval: true)]
    #[Groups(['read:Federation:collection'])]
    private Collection $societies;

    public function __construct()
    {
        $this->societies = new ArrayCollection();
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

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(Department $department): static
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return Collection<int, Society>
     */
    public function getSocieties(): Collection
    {
        return $this->societies;
    }

    public function addSociety(Society $society): static
    {
        if (!$this->societies->contains($society)) {
            $this->societies->add($society);
            $society->setFederation($this);
        }

        return $this;
    }

    public function removeSociety(Society $society): static
    {
        if ($this->societies->removeElement($society)) {
            // set the owning side to null (unless already changed)
            if ($society->getFederation() === $this) {
                $society->setFederation(null);
            }
        }

        return $this;
    }
}
