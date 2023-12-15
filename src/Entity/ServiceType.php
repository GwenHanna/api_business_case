<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ServiceTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['serviceType:read']],
    denormalizationContext:['groups' => ['serviceType:post']],
    operations: [
        new Get(
        ),
        new Patch(),
        new Delete(),
        new GetCollection(),
        new Post(
        ),

    ]
    
)]
#[ORM\Entity(repositoryClass: ServiceTypeRepository::class)]
class ServiceType
{
    #[Groups(['serviceType:read', 'section:read', 'serviceType:post'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['serviceType:read','section:read',  'section:read', 'articles:post', 'serviceType:post','section:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['serviceType:read','section:read', 'serviceType:post', 'section:patch'])]
    #[ORM\Column(length: 600)]
    private ?string $description = null;

    #[Groups(['serviceType:read','section:read', 'serviceType:post', 'section:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[Groups(['serviceType:post', 'serviceType:read'])]
    #[ORM\ManyToOne(inversedBy: 'serviceTypes')]
    private ?Section $section = null;

    #[ORM\OneToMany(mappedBy: 'serviceType', targetEntity: Service::class)]
    private Collection $service;

    public function __construct()
    {
        $this->service = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): static
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->service;
    }

    public function addService(Service $serviceType): static
    {
        if (!$this->service->contains($serviceType)) {
            $this->service->add($serviceType);
            $serviceType->setServiceType($this);
        }

        return $this;
    }

    public function removeService(Service $serviceType): static
    {
        if ($this->service->removeElement($serviceType)) {
            // set the owning side to null (unless already changed)
            if ($serviceType->getServiceType() === $this) {
                $serviceType->setServiceType(null);
            }
        }

        return $this;
    }
}
