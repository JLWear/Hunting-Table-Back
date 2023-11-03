<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DepartmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => 'read:Federation:collection']
)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\OneToOne(mappedBy: 'department', cascade: ['persist', 'remove'])]
    #[Groups(['read:Federation:collection'])]
    private ?Federation $federation = null;

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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getFederation(): ?Federation
    {
        return $this->federation;
    }
}
