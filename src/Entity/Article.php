<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use App\Dto\PricingDto;
use App\Repository\ArticleRepository;
use App\State\PricingProvider;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    paginationEnabled: false,

    operations: [


        new Get(
            normalizationContext: ['groups' => ['article:read']],
            uriTemplate: '/articles/{id}/pricing',
            output: PricingDto::class,
            provider: PricingProvider::class,
        ),
        new Get(
            normalizationContext: ['groups' => ['article:read']],
            uriTemplate: '/articles/{id}',
        ),
        new Patch(
            normalizationContext: ['groups' => ['article:patch']],
            denormalizationContext: ['groups' => ['article:patch']]
        ),
        new Delete(),
        new GetCollection(
            normalizationContext: ['groups' => ['article:read']],
            denormalizationContext: ['groups' => ['article:post']],
        ),
        new Post(

            denormalizationContext: ['groups' => ['article:post']],
        ),

    ]

)]
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{

    #[Groups(['article:read', 'serviceType:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['article:read', 'serviceType:read', 'article:post', 'article:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['article:read', 'article:post', 'article:patch'])]
    #[ORM\Column]
    private ?float $price = null;

    #[Groups(['article:read', 'article:post', 'article:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $picture = null;



    #[Groups(['article:read', 'article:post', 'article:patch'])]
    #[ORM\ManyToOne(inversedBy: 'service')]
    private ?ServiceType $serviceType = null;


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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getServiceType(): ?ServiceType
    {
        return $this->serviceType;
    }

    public function setServiceType(?ServiceType $serviceType): static
    {
        $this->serviceType = $serviceType;

        return $this;
    }
}
