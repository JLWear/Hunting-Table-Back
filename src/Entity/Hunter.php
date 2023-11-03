<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HunterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HunterRepository::class)]
#[ApiResource]
class Hunter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\OneToOne(mappedBy: 'hunter', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'hunter', targetEntity: Hunt::class)]
    private Collection $hunts;

    #[ORM\ManyToMany(targetEntity: Hunt::class, mappedBy: 'participant')]
    private Collection $groupHunt;

    public function __construct()
    {
        $this->hunts = new ArrayCollection();
        $this->groupHunt = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setHunter(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getHunter() !== $this) {
            $user->setHunter($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Hunt>
     */
    public function getHunts(): Collection
    {
        return $this->hunts;
    }

    public function addHunt(Hunt $hunt): static
    {
        if (!$this->hunts->contains($hunt)) {
            $this->hunts->add($hunt);
            $hunt->setHunter($this);
        }

        return $this;
    }

    public function removeHunt(Hunt $hunt): static
    {
        if ($this->hunts->removeElement($hunt)) {
            // set the owning side to null (unless already changed)
            if ($hunt->getHunter() === $this) {
                $hunt->setHunter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Hunt>
     */
    public function getGroupHunt(): Collection
    {
        return $this->groupHunt;
    }
}
