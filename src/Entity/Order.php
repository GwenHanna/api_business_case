<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;

#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['order:read']]
        ),
        new Patch(),
        new Delete(),
        new GetCollection( 
            normalizationContext: ['groups' => ['order:read']]    
        ),
        new Post(
            
        ),
    ]
    
)]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('order:read')]
    private ?int $id = null;

    #[Groups('order:read')]
    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[Groups('order:read')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $payementDate = null;

    #[Groups('order:read')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $depotDate = null;

    #[Groups('order:read')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $pickUpDate = null;

    #[Groups('order:read')]
    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $user = null;

    #[Groups('order:read')]
    #[ORM\ManyToOne(inversedBy: 'ordersAssign')]
    private ?User $employee = null;

    #[ORM\OneToMany(mappedBy: 'orderId', targetEntity: Selection::class)]
    private Collection $selections;

    #[ORM\OneToMany(mappedBy: 'orderId', targetEntity: Article::class)]
    private Collection $articles;

    public function __construct()
    {
        $this->selections = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPayementDate(): ?\DateTimeInterface
    {
        return $this->payementDate;
    }

    public function setPayementDate(\DateTimeInterface $payementDate): static
    {
        $this->payementDate = $payementDate;

        return $this;
    }

    public function getDepotDate(): ?\DateTimeInterface
    {
        return $this->depotDate;
    }

    public function setDepotDate(\DateTimeInterface $depotDate): static
    {
        $this->depotDate = $depotDate;

        return $this;
    }

    public function getPickUpDate(): ?\DateTimeInterface
    {
        return $this->pickUpDate;
    }

    public function setPickUpDate(\DateTimeInterface $pickUpDate): static
    {
        $this->pickUpDate = $pickUpDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getEmployee(): ?User
    {
        return $this->employee;
    }

    public function setEmployee(?User $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * @return Collection<int, Selection>
     */
    public function getSelections(): Collection
    {
        return $this->selections;
    }

    public function addSelection(Selection $selection): static
    {
        if (!$this->selections->contains($selection)) {
            $this->selections->add($selection);
            $selection->setOrderId($this);
        }

        return $this;
    }

    public function removeSelection(Selection $selection): static
    {
        if ($this->selections->removeElement($selection)) {
            // set the owning side to null (unless already changed)
            if ($selection->getOrderId() === $this) {
                $selection->setOrderId(null);
            }
        }

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
            $article->setOrderId($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getOrderId() === $this) {
                $article->setOrderId(null);
            }
        }

        return $this;
    }

}
