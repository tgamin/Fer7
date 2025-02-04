<?php

namespace App\Entity;

use App\Repository\RealisationTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealisationTypeRepository::class)]
class RealisationType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var Collection<int, Realisations>
     */
    #[ORM\ManyToMany(targetEntity: Realisations::class, inversedBy: 'realisationTypes')]
    private Collection $realisation;

    public function __construct()
    {
        $this->realisation = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Realisations>
     */
    public function getRealisation(): Collection
    {
        return $this->realisation;
    }

    public function addRealisation(Realisations $realisation): static
    {
        if (!$this->realisation->contains($realisation)) {
            $this->realisation->add($realisation);
        }

        return $this;
    }

    public function removeRealisation(Realisations $realisation): static
    {
        $this->realisation->removeElement($realisation);

        return $this;
    }
    
    public function __toString(): string
    {
       

        return $this->getTitle();
    }
}
