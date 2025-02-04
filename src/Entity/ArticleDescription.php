<?php

namespace App\Entity;

use App\Repository\ArticleDescriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleDescriptionRepository::class)]
class ArticleDescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'articleDescriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artical $artical = null;

   

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getArtical(): ?Artical
    {
        return $this->artical;
    }

    public function setArtical(?Artical $artical): static
    {
        $this->artical = $artical;

        return $this;
    }

    

   
}
