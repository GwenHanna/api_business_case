<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\Put;

#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['section:read']]
        ),
        new Patch(
            denormalizationContext: ['groups' => ['section:patch']]
        ),
        new Delete(),
        new GetCollection( 
            normalizationContext: ['groups' => ['section:read']]  
        ),
        new Post(
            denormalizationContext: ['groups' => ['section:post']] 
        )
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'exact'])]
#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['section:read','section:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['section:read','section:patch'])]
    #[ORM\OneToMany(mappedBy: 'section', targetEntity: Service::class)]
    private Collection $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
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

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->setSection($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getSection() === $this) {
                $service->setSection(null);
            }
        }

        return $this;
    }
}
