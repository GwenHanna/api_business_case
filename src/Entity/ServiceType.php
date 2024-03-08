<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Repository\ServiceTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;


#[ApiResource(
    operations: [
        // GET operation configuration
        new Get(
            normalizationContext: ['groups' => ['serviceType:read']],
        ),
        // PATCH operation configuration
        new Patch(
            normalizationContext: ['groups' => ['serviceType:read']],
            denormalizationContext: ['groups' => ['serviceType:read']]
        ),
        // DELETE operation configuration
        new Delete(),
        // GET operation configuration
        new GetCollection(
            normalizationContext: ['groups' => ['serviceType:read']],
            denormalizationContext: ['groups' => ['serviceType:read']]
        ),
        // POST operation configuration
        new Post(
            normalizationContext: ['groups' => ['serviceType:read']],
            denormalizationContext: ['groups' => ['serviceType:read']]
        ),
    ]

)]
#[ORM\Entity(repositoryClass: ServiceTypeRepository::class)]
class ServiceType
{
    // Identifiant unique du type service .
    #[Groups(['serviceType:read', 'section:read', 'serviceType:post', 'service:read'])]
    // Annotation pour indiquer qu'il s'agit de
    // la clé primaire dans la base de données
    #[ORM\Id]
    // Annotation pour indiquer que la valeur de 
    // la clé primaire est générée automatiquement(auto-increment)
    #[ORM\GeneratedValue]
    // Annotation pour spécifier une colonne dans la base de données
    #[ORM\Column]
    // Déclaration d'une propriété privée pour l'identifiant unique du type de service
    private ?int $id = null;

    // Nom du type service .
    #[Groups(['serviceType:read', 'section:read', 'articles:post', 'section:patch', 'service:read', 'serviceType:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // Description du type service 
    #[Groups(['serviceType:read', 'section:read', 'serviceType:post', 'section:patch', 'serviceType:patch'])]
    #[ORM\Column(length: 600)]
    private ?string $description = null;

    // URL de l'image représentant le type service 
    #[Groups(['serviceType:read', 'section:read', 'serviceType:post', 'section:patch', 'serviceType:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    // Section à laquelle appartient le type service 
    #[Groups(['serviceType:post', 'serviceType:read', 'serviceType:patch', 'service:read'])]
    #[ORM\ManyToOne(inversedBy: 'serviceTypes')]
    private ?Section $section = null;

    //  Liste des services associés à ce type service 
    #[Groups(['serviceType:read', 'serviceType:post', 'service:read'])]
    #[ORM\OneToMany(mappedBy: 'serviceType', targetEntity: Service::class)]
    private Collection $service;

    #[Groups(['serviceType:read', 'section:read', 'serviceType:post', 'section:patch', 'serviceType:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $icon = null;

    public function __construct()
    {
        // Initialise la propriété "service" avec 
        // une nouvelle instance de ArrayCollection
        $this->service = new ArrayCollection();
    }

    // Les Getter et les Setter 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        // Retourne l'instance 
        return $this->name;
    }

    public function setName(string $name): static
    {
        // Modifie la valeur de la propriété "name"
        // avec la nouvelle valeur fournie
        $this->name = $name;

        // Retourne l'instance modifiée de l'entité
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }
}
