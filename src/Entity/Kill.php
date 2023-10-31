<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\KillRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KillRepository::class)]
#[ORM\Table(name: '`kill`')]
#[ApiResource]
class Kill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\ManyToOne(inversedBy: 'huntKill')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hunt $hunt = null;

    #[ORM\OneToOne(inversedBy: 'huntKill', cascade: ['persist', 'remove'])]
    private ?Specie $specie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getHunt(): ?Hunt
    {
        return $this->hunt;
    }

    public function setHunt(?Hunt $hunt): static
    {
        $this->hunt = $hunt;

        return $this;
    }

    public function getSpecie(): ?Specie
    {
        return $this->specie;
    }

    public function setSpecie(?Specie $specie): static
    {
        $this->specie = $specie;

        return $this;
    }
}
