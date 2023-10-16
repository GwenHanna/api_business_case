<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['order:read']]
)]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('order:read')]
    private ?int $id = null;

    #[Groups('order:read')]
    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[Groups('order:read')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $payementDate = null;

    #[Groups('order:read')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $depotDate = null;

    #[Groups('order:read')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $pickUpDate = null;

    #[Groups('order:read')]
    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $user = null;

    #[Groups('order:read')]
    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Basket $basket = null;

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

    public function getPickUpDate(): ?\DateTimeInterface
    {
        return $this->pickUpDate;
    }

    public function setPickUpDate(\DateTimeInterface $pickUpDate): static
    {
        $this->pickUpDate = $pickUpDate;

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

    public function getBasket(): ?Basket
    {
        return $this->basket;
    }

    public function setBasket(?Basket $basket): static
    {
        $this->basket = $basket;

        return $this;
    }
}