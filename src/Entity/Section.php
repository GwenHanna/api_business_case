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
            normalizationContext: ['groups' => ['section:read']],
            denormalizationContext: ['groups' => ['section:post']]
        ),
        new Post(
            normalizationContext: ['groups' => ['section:read']],
            denormalizationContext: ['groups' => ['section:post']]
        )
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'exact'])]
#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[Groups(['section:read', 'serviceType:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['section:read', 'section:patch', 'section:post', 'serviceType:read', 'section:post', 'article:read'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['section:read', 'section:post'])]
    #[ORM\OneToMany(mappedBy: 'section', targetEntity: ServiceType::class)]
    private Collection $serviceTypes;


    public function __construct()
    {
        $this->serviceTypes = new ArrayCollection();
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
     * @return Collection<int, ServiceType>
     */
    public function getServiceTypes(): Collection
    {
        return $this->serviceTypes;
    }

    public function addServiceType(ServiceType $serviceType): static
    {
        if (!$this->serviceTypes->contains($serviceType)) {
            $this->serviceTypes->add($serviceType);
            $serviceType->setSection($this);
        }

        return $this;
    }

    public function removeServiceType(ServiceType $serviceType): static
    {
        if ($this->serviceTypes->removeElement($serviceType)) {
            // set the owning side to null (unless already changed)
            if ($serviceType->getSection() === $this) {
                $serviceType->setSection(null);
            }
        }

        return $this;
    }
}
