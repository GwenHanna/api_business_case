<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\UserRepository;
use App\State\UserPasswordHasher;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(
            processor: UserPasswordHasher::class,
            denormalizationContext: ['groups'     => ['user:post']]
        ),
        new Get(
            normalizationContext: ['groups'     => ['user:read']]
        ),
        new Put(processor: UserPasswordHasher::class),
        new Patch(
            processor: UserPasswordHasher::class,
            denormalizationContext: ['groups'     => ['user:patch']]
        ),
        new Delete(
            denormalizationContext: ['groups'     => ['delete:post']]
        ),
    ],

)]
#[ApiFilter(SearchFilter::class, properties: ['roles'])]
#[ApiFilter(SearchFilter::class, properties: ['email'])]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity("email", message: "Cet email éexiste déjà.")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column]
    #[Groups(['order:patch', 'user:delete', 'user:read', 'order:read'])]
    private ?int $id = null;

    #[Assert\Email(
        message: 'Votre email est invalid.',
    )]
    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['user:delete', 'user:read', 'user:post', 'user:patch', 'order:patch'])]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups(['user:delete', 'user:read', 'user:post'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Length(
        min: 12,
        max: 5000
    )]
    #[Groups('user:delete')]
    private ?string $password = null;

    #[Assert\Length(
        min: 12,
        max: 5000,
        minMessage: 'Votre mot de passe doit avoir minimum {{ limit }} caractères',
    )]
    #[Groups(['user:delete', 'user:post', 'user:patch'])]
    private ?string $plainPassword = null;

    #[Groups(['user:delete', 'user:read', 'user:post', 'comment:read', 'order:read', 'user:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[Groups(['user:delete', 'user:read', 'user:post', 'comment:read', 'user:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[Groups(['user:delete', 'user:read', 'user:post'])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthdate = null;

    #[Groups(['user:delete', 'user:read', 'user:post', 'user:patch'])]
    #[ORM\Column(length: 10, nullable: true)]
    private ?string $gender = null;

    #[Groups(['user:delete', 'user:read', 'user:post', 'user:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[Groups(['user:delete', 'user:read', 'user:post', 'user:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $zipcode = null;

    #[Groups(['user:delete', 'user:read', 'user:post', 'user:patch'])]
    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[Groups(['user:delete', 'user:read'])]
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Order::class, cascade: ["remove", "persist"])]
    private Collection $orders;

    #[Groups(['user:delete', 'user:read'])]
    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Comment::class, cascade: ["remove", "persist"])]
    private Collection $comments;

    #[Groups(['user:delete', 'user:read', 'user:post'])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCreated = null;


    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        // $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): static
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(?\DateTimeInterface $dateCreated): static
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }
}
