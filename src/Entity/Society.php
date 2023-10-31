<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SocietyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocietyRepository::class)]
#[ApiResource]
class Society
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'society', targetEntity: Hunt::class)]
    private Collection $hunts;

    #[ORM\OneToMany(mappedBy: 'society', targetEntity: Quota::class)]
    private Collection $quotas;

    #[ORM\ManyToOne(inversedBy: 'societies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Federation $federation = null;

    public function __construct()
    {
        $this->hunts = new ArrayCollection();
        $this->quotas = new ArrayCollection();
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
            $hunt->setSociety($this);
        }

        return $this;
    }

    public function removeHunt(Hunt $hunt): static
    {
        if ($this->hunts->removeElement($hunt)) {
            // set the owning side to null (unless already changed)
            if ($hunt->getSociety() === $this) {
                $hunt->setSociety(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Quota>
     */
    public function getQuotas(): Collection
    {
        return $this->quotas;
    }

    public function addQuota(Quota $quota): static
    {
        if (!$this->quotas->contains($quota)) {
            $this->quotas->add($quota);
            $quota->setSociety($this);
        }

        return $this;
    }

    public function removeQuota(Quota $quota): static
    {
        if ($this->quotas->removeElement($quota)) {
            // set the owning side to null (unless already changed)
            if ($quota->getSociety() === $this) {
                $quota->setSociety(null);
            }
        }

        return $this;
    }

    public function getFederation(): ?Federation
    {
        return $this->federation;
    }

    public function setFederation(?Federation $federation): static
    {
        $this->federation = $federation;

        return $this;
    }
}
