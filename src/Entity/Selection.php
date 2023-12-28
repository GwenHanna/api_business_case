<?php

namespace App\Entity;

use App\Repository\SelectionRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['selection:read']]
        ),
        new Patch(),
        new Delete(),
        new GetCollection( 
            normalizationContext: ['groups' => ['selection:read']]  
        ),
        new Post(),
    ]
    
)]
#[ORM\Entity(repositoryClass: SelectionRepository::class)]
class Selection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups( 'selection:read')]
    #[ORM\ManyToOne(inversedBy: 'selections')]
    private ?Service $service = null;

    #[Groups( 'selection:read')]
    #[ORM\ManyToOne(inversedBy: 'selections')]
    private ?Article $article = null;

    #[ORM\Column(length: 255)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'selections')]
    private ?Order $orderId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getOrderId(): ?Order
    {
        return $this->orderId;
    }

    public function setOrderId(?Order $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }
}
