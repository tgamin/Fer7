<?php

namespace App\Entity;

use App\Repository\ArticalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticalRepository::class)]
class Artical
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;



    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * @var Collection<int, ArticleType>
     */
    #[ORM\ManyToMany(targetEntity: ArticleType::class, mappedBy: 'artical')]
    private Collection $articleTypes;

    /**
     * @var Collection<int, ArticleDescription>
     */
    #[ORM\OneToMany(targetEntity: ArticleDescription::class, mappedBy: 'artical')]
    private Collection $articleDescriptions;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $conclusion = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;
   
    
    public function __construct(){
        
        $this->date = new \DateTime();
        $this->articleTypes = new ArrayCollection();
        $this->articleDescriptions = new ArrayCollection(); 
        // $this->slug = $this->generateSlug($title);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;
        // $this->slug = $this->generateSlug($title);

        return $this;
    }

    

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, ArticleType>
     */
    public function getArticleTypes(): Collection
    {
        return $this->articleTypes;
    }

    public function addArticleType(ArticleType $articleType): static
    {
        if (!$this->articleTypes->contains($articleType)) {
            $this->articleTypes->add($articleType);
            $articleType->addArtical($this);
        }

        return $this;
    }

    public function removeArticleType(ArticleType $articleType): static
    {
        if ($this->articleTypes->removeElement($articleType)) {
            $articleType->removeArtical($this);
        }

        return $this;
    }
     public function __toString(): string
    {
       
        return $this->getTitle();
    }

     /**
      * @return Collection<int, ArticleDescription>
      */
     public function getArticleDescriptions(): Collection
     {
         return $this->articleDescriptions;
     }

     public function addArticleDescription(ArticleDescription $articleDescription): static
     {
         if (!$this->articleDescriptions->contains($articleDescription)) {
             $this->articleDescriptions->add($articleDescription);
             $articleDescription->setArtical($this);
         }

         return $this;
     }

     public function removeArticleDescription(ArticleDescription $articleDescription): static
     {
         if ($this->articleDescriptions->removeElement($articleDescription)) {
             // set the owning side to null (unless already changed)
             if ($articleDescription->getArtical() === $this) {
                 $articleDescription->setArtical(null);
             }
         }

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

    public function getConclusion(): ?string
    {
        return $this->conclusion;
    }

    public function setConclusion(string $conclusion): static
    {
        $this->conclusion = $conclusion;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
    
    // private function generateSlug(string $title): string
    // {
    //     return strtolower(trim(preg_replace('/[^a-z0-9]+/', '-', $title), '-'));
    // }
  
}
