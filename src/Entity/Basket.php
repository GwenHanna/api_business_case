<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['basket:read']]
)]
#[ORM\Entity(repositoryClass: BasketRepository::class)]
class Basket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('basket:read')]
    #[ORM\ManyToOne(inversedBy: 'baskets')]
    private ?Selection $selection = null;

    #[Groups('basket:read')]
    #[ORM\OneToMany(mappedBy: 'basket', targetEntity: Order::class)]
    private Collection $orders;

    #[Groups('basket:read')]
    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSelection(): ?Selection
    {
        return $this->selection;
    }

    public function setSelection(?Selection $selection): static
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setBasket($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getBasket() === $this) {
                $order->setBasket(null);
            }
        }

        return $this;
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
}
