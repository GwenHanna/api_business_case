<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    paginationEnabled:false,

    operations: [
        new Get(
            normalizationContext:['groups' => ['articles:read']],
            
        ),
        new Patch(
            normalizationContext:['groups' => ['articles:patch:read']],
            denormalizationContext: ['groups' => ['article:patch']]
        ),
        new Delete(),
        new GetCollection( 
            normalizationContext:['groups' => ['articles:read', 'articles:post:read']],
            denormalizationContext: ['groups' => ['article:post']],
        ),
        new Post(
            denormalizationContext: ['groups' => ['article:post']],
            normalizationContext:['groups' => ['articles:post:read']],
        ),
    ]

)]
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('articles:read')]
    private ?int $id = null;



    #[Groups(['articles:read', 'category:read', 'service:read', 'prestation:read','article:post', 'articles:post:read'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['articles:read', 'prestation:read', 'article:post', 'articles:post:read'])]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Groups(['articles:read', 'article:post', 'articles:post:read'])]
    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Category $category = null;

    #[Groups(['articles:read', 'service:read', 'prestation:read','article:post', 'articles:post:read'])]
    #[ORM\Column]
    private ?float $price = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Prestation::class)]
    private Collection $prestations;

    #[Groups(['articles:read', 'prestation:read','service:read','article:post', 'articles:post:read'])]
    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[Groups(['articles:read','article:post', 'articles:post:read'])]
    #[ORM\ManyToMany(targetEntity: Service::class, mappedBy: 'articles')]
    private Collection $services;

    public function __construct()
    {
        $this->prestations = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }




    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

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

    /**
     * @return Collection<int, Prestation>
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Prestation $prestation): static
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations->add($prestation);
            $prestation->setArticle($this);
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): static
    {
        if ($this->prestations->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getArticle() === $this) {
                $prestation->setArticle(null);
            }
        }

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
            $service->addArticle($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->services->removeElement($service)) {
            $service->removeArticle($this);
        }

        return $this;
    }

    #[Groups('articles:read')]
    #[ApiProperty()]
    private ?string $code = null;

    /**
     * Get the value of code
     */ 
    public function getCode()
    {

        return $this->getServices()[0]->getName() . '_' . $this->getName();
    }
}
