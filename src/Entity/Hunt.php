<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HuntRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HuntRepository::class)]
#[ApiResource]
class Hunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'hunts')]
    private ?Hunter $hunter = null;

    #[ORM\ManyToOne(inversedBy: 'hunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Society $society = null;

    #[ORM\ManyToMany(targetEntity: Hunter::class, inversedBy: 'groupHunt')]
    private Collection $participant;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'hunt', targetEntity: Kill::class, orphanRemoval: true)]
    private Collection $huntKill;

    public function __construct()
    {
        $this->participant = new ArrayCollection();
        $this->huntKill = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHunter(): ?Hunter
    {
        return $this->hunter;
    }

    public function setHunter(?Hunter $hunter): static
    {
        $this->hunter = $hunter;

        return $this;
    }

    public function getSociety(): ?Society
    {
        return $this->society;
    }

    public function setSociety(?Society $society): static
    {
        $this->society = $society;

        return $this;
    }

    /**
     * @return Collection<int, Hunter>
     */
    public function getParticipant(): Collection
    {
        return $this->participant;
    }

    public function addParticipant(Hunter $participant): static
    {
        if (!$this->participant->contains($participant)) {
            $this->participant->add($participant);
        }

        return $this;
    }

    public function removeParticipant(Hunter $participant): static
    {
        $this->participant->removeElement($participant);

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    /**
     * @return Collection<int, Kill>
     */
    public function getHuntKill(): Collection
    {
        return $this->huntKill;
    }

    public function addHuntKill(Kill $huntKill): static
    {
        if (!$this->huntKill->contains($huntKill)) {
            $this->huntKill->add($huntKill);
            $huntKill->setHunt($this);
        }

        return $this;
    }

    public function removeHuntKill(Kill $huntKill): static
    {
        if ($this->huntKill->removeElement($huntKill)) {
            // set the owning side to null (unless already changed)
            if ($huntKill->getHunt() === $this) {
                $huntKill->setHunt(null);
            }
        }

        return $this;
    }
}
