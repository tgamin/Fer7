<?php

namespace App\Entity;

use App\Repository\RealisationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealisationsRepository::class)]
class Realisations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Images>
     */
    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'realisation')]
    private Collection $images;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $superficie = null;

    /**
     * @var Collection<int, RealisationType>
     */
    #[ORM\ManyToMany(targetEntity: RealisationType::class, mappedBy: 'realisation')]
    private Collection $realisationTypes;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionPrincipal = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->realisationTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
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

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setRealisation($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getRealisation() === $this) {
                $image->setRealisation(null);
            }
        }

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getSuperficie(): ?string
    {
        return $this->superficie;
    }

    public function setSuperficie(?string $superficie): static
    {
        $this->superficie = $superficie;

        return $this;
    }

    /**
     * @return Collection<int, RealisationType>
     */
    public function getRealisationTypes(): Collection
    {
        return $this->realisationTypes;
    }

    public function addRealisationType(RealisationType $realisationType): static
    {
        if (!$this->realisationTypes->contains($realisationType)) {
            $this->realisationTypes->add($realisationType);
            $realisationType->addRealisation($this);
        }

        return $this;
    }

    public function removeRealisationType(RealisationType $realisationType): static
    {
        if ($this->realisationTypes->removeElement($realisationType)) {
            $realisationType->removeRealisation($this);
        }

        return $this;
    }
    
    public function __toString(): string
    {
       
        return $this->getTitle();
    }

    public function getDescriptionPrincipal(): ?string
    {
        return $this->descriptionPrincipal;
    }

    public function setDescriptionPrincipal(?string $descriptionPrincipal): static
    {
        $this->descriptionPrincipal = $descriptionPrincipal;

        return $this;
    }
}
