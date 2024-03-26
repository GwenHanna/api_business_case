<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use App\Dto\PricingDto;
use App\Repository\ServiceRepository;
use App\State\PricingProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    paginationEnabled: false,

    operations: [


        new Get(
            normalizationContext: ['groups' => ['service:read']],
            uriTemplate: '/services/{id}/pricing',
            output: PricingDto::class,
            provider: PricingProvider::class,
        ),
        new Get(
            normalizationContext: ['groups' => ['service:read']],
            uriTemplate: '/services/{id}',
        ),
        new Patch(
            normalizationContext: ['groups' => ['service:patch']],
            denormalizationContext: ['groups' => ['service:patch']]
        ),
        new Delete(),
        new GetCollection(
            normalizationContext: ['groups' => ['service:read']],
            denormalizationContext: ['groups' => ['service:post']],
        ),
        new Post(

            denormalizationContext: ['groups' => ['service:post']],
        ),

    ]

)]
#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{

    #[Groups(['service:read', 'serviceType:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['service:read', 'serviceType:read', 'service:post', 'service:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['service:read', 'service:post', 'service:patch'])]
    #[ORM\Column]
    private ?float $price = null;

    #[Groups(['service:read', 'service:post', 'service:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $picture = null;



    #[Groups(['service:read', 'service:post', 'service:patch'])]
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
