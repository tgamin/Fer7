<?php

namespace App\Entity;

use App\Repository\ArticleTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleTypeRepository::class)]
class ArticleType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var Collection<int, Artical>
     */
    #[ORM\ManyToMany(targetEntity: Artical::class, inversedBy: 'articleTypes')]
    private Collection $artical;

    public function __construct()
    {
        $this->artical = new ArrayCollection();
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
     * @return Collection<int, Artical>
     */
    public function getArtical(): Collection
    {
        return $this->artical;
    }

    public function addArtical(Artical $artical): static
    {
        if (!$this->artical->contains($artical)) {
            $this->artical->add($artical);
        }

        return $this;
    }

    public function removeArtical(Artical $artical): static
    {
        $this->artical->removeElement($artical);

        return $this;
    }
}
