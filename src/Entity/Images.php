<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titleImage = null;



    #[ORM\Column(length: 255)]
    private ?string $upload = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Realisations $realisation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleImage(): ?string
    {
        return $this->titleImage;
    }

    public function setTitleImage(?string $titleImage): static
    {
        $this->titleImage = $titleImage;

        return $this;
    }

 

    public function getUpload(): ?string
    {
        return $this->upload;
    }

    public function setUpload(string $upload): static
    {
        $this->upload = $upload;

        return $this;
    }

    public function getRealisation(): ?Realisations
    {
        return $this->realisation;
    }

    public function setRealisation(?Realisations $realisation): static
    {
        $this->realisation = $realisation;

        return $this;
    }
}
