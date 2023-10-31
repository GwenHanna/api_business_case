<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ApiResource(
    normalizationContext: [
        'groups' => ['articles:read']
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


    #[Groups(['articles:read', 'category:read', 'service:read'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups('articles:read')]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Groups('articles:read')]
    #[ORM\Column(length: 255)]
    private ?string $state = null;

    #[Groups('articles:read')]
    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Category $category = null;

    #[Groups(['articles:read', 'service:read'])]
    #[ORM\Column]
    private ?float $price = null;

    #[Groups('articles:read')]
    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Prestation::class)]
    private Collection $prestations;


    public function __construct()
    {
        $this->prestations = new ArrayCollection();
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

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

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
}
