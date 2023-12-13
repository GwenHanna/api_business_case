<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
            normalizationContext: ['groups' => ['prestation:read']]
        ),
        new Patch(),
        new Delete(),
        new GetCollection( 
            normalizationContext: ['groups' => ['prestation:read']]  
        ),
        new Post(),
    ]
    
)]
#[ApiFilter(SearchFilter::class, properties:['service.id'])]
#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups( 'prestation:read')]
    #[ORM\ManyToOne(inversedBy: 'prestations')]
    private ?Article $article = null;

    #[Groups( 'prestation:read')]
    #[ORM\ManyToOne(inversedBy: 'prestations')]
    private ?Service $service = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    

}
