<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;

#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['service:read']]
        ),
        new Patch(),
        new Delete(),
        new GetCollection( 
            normalizationContext: ['groups' => ['service:read']] 
        ),
        new Post(
            denormalizationContext:['groups' => ['service:post']]
        ),

    ]
    
)]

#[ApiFilter(SearchFilter::class, properties:['category'])]
#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[Groups(['articles:read', 'service:read', 'prestation:read', 'section:read', 'service:post'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['articles:read', 'service:read', 'prestation:read', 'section:read', 'articles:post', 'service:post','section:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['service:read','service:post', 'section:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Groups(['articles:read', 'service:read', 'prestation:read', 'service:post','section:patch'])]
    #[ORM\Column]
    private ?float $price = null;

    #[Groups(['service:read','section:read', 'service:post', 'section:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[Groups(['service:read', 'prestation:read', 'service:post','section:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\ManyToOne(inversedBy: 'services', cascade: ['persist'])]
    private ?Section $section = null;
    
    #[Groups(['service:read', 'service:post'])]
    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'services')]
    private Collection $articles;


    public function __construct()
    {
        $this->articles = new ArrayCollection();
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

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
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        $this->articles->removeElement($article);

        return $this;
    }

}
