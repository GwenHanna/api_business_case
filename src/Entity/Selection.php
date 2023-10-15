<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SelectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['selection:read']]
)]
#[ORM\Entity(repositoryClass: SelectionRepository::class)]
class Selection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('selection:read')]
    private ?int $id = null;

    #[Groups('selection:read')]
    #[ORM\Column]
    private ?int $quantity = null;

    #[Groups('selection:read')]
    #[ORM\Column]
    private ?float $priceTotal = null;

    #[Groups('selection:read')]
    #[ORM\ManyToOne(inversedBy: 'selections')]
    private ?Service $services = null;

    #[Groups('selection:read')]
    #[ORM\OneToMany(mappedBy: 'selection', targetEntity: Basket::class)]
    private Collection $baskets;

    public function __construct()
    {
        $this->baskets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPriceTotal(): ?float
    {
        return $this->priceTotal;
    }

    public function setPriceTotal(float $priceTotal): static
    {
        $this->priceTotal = $priceTotal;

        return $this;
    }

    public function getServices(): ?Service
    {
        return $this->services;
    }

    public function setServices(?Service $services): static
    {
        $this->services = $services;

        return $this;
    }

    /**
     * @return Collection<int, Basket>
     */
    public function getBaskets(): Collection
    {
        return $this->baskets;
    }

    public function addBasket(Basket $basket): static
    {
        if (!$this->baskets->contains($basket)) {
            $this->baskets->add($basket);
            $basket->setSelection($this);
        }

        return $this;
    }

    public function removeBasket(Basket $basket): static
    {
        if ($this->baskets->removeElement($basket)) {
            // set the owning side to null (unless already changed)
            if ($basket->getSelection() === $this) {
                $basket->setSelection(null);
            }
        }

        return $this;
    }
}
