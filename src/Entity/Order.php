<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;

#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['order:read']]
        ),
        new Patch(
            normalizationContext: ['groups' => ['order:patch']],
            denormalizationContext: ['groups' => ['order:patch']],
        ),
        new Delete(),
        new GetCollection(
            normalizationContext: ['groups' => ['order:read']]
        ),
        new Post(),
    ]

)]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['order:read'])]
    private ?int $id = null;

    #[Groups(['order:read', 'order:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[Groups('order:read')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $payementDate = null;

    #[Groups('order:read')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $depotDate = null;


    #[Groups(['order:read'])]
    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Article $article = null;

    #[Groups(['order:read', 'order:patch'])]
    #[ORM\Column(length: 10, nullable: true)]
    private ?string $employee_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPayementDate(): ?\DateTimeInterface
    {
        return $this->payementDate;
    }

    public function setPayementDate(\DateTimeInterface $payementDate): static
    {
        $this->payementDate = $payementDate;

        return $this;
    }

    public function getDepotDate(): ?\DateTimeInterface
    {
        return $this->depotDate;
    }

    public function setDepotDate(\DateTimeInterface $depotDate): static
    {
        $this->depotDate = $depotDate;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getEmployeeId(): ?string
    {
        return $this->employee_id;
    }

    public function setEmployeeId(?string $employee_id): static
    {
        $this->employee_id = $employee_id;

        return $this;
    }
}
