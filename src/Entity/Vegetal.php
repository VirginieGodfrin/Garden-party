<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use App\Entity\Mangeur;
use App\Entity\Jardinier;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as myAssert;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "vegetal" = "Vegetal",
 *     "fleur" = "Fleur", 
 *     "fruit" = "Fruit",
 *     "legume" = "Legume",
 *     "arbre" = "Arbre"
 * })
 * @ORM\HasLifecycleCallbacks()
 */
class Vegetal 
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Oups tu as oublié la description!")
     * @myAssert\ContainsCarotte
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Oups tu as oublié la description!")
     */
    private $description;

    /**
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="Jardinier", mappedBy="vegetals")
     */
    private $jardiniers;

    /**
     * @ORM\ManyToOne(targetEntity="Mangeur", inversedBy="vegetals")
     */
    private $mangeur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isUpdate = false;


    public function __construct()
    {
        $this->jardiniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return Collection|Jardinier[]
     */
    public function getJardiniers(): Collection
    {
        return $this->jardiniers;
    }

    public function addJardinier(Jardinier $jardinier): self
    {
        if ($this->jardiniers->contains($jardinier)) {
             return $this; 
        }

        $this->jardiniers[] = $jardinier;
        $jardinier->addVegetal($this);

        return $this;
    }

    public function removeJardinier(Jardinier $jardinier): self
    {
        if ($this->jardiniers->contains($jardinier)) {
            $this->jardiniers->removeElement($jardinier);
            $jardinier->removeVegetal($this);
        }

        return $this;
    }

    public function getMangeur(): ?Mangeur
    {
        return $this->mangeur;
    }

    public function setMangeur(?Mangeur $mangeur): self
    {
        $this->mangeur = $mangeur;

        return $this;
    }

    public function getIsUpdate(): ?bool
    {
        return $this->isUpdate;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setIsUpdate(): self
    {
        $this->isUpdate = true;

        return $this;
    }

    
}
