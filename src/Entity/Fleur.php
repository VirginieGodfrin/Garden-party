<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Mangeur;
use App\Entity\Vegetal;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FleurRepository")
 */
class Fleur extends Vegetal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bouquet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Legume", mappedBy="fleurs")
     */
    private $legumes;

    public function __construct()
    {
        parent::__construct();
        $this->legumes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return parent::getId();
    }

    public function getBouquet(): ?string
    {
        return $this->bouquet;
    }

    public function setBouquet(?string $bouquet): self
    {
        $this->bouquet = $bouquet;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    // https://stackoverflow.com/questions/22550368/how-can-we-get-class-name-of-the-entity-object-in-twig-view
    public function getClassName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    /**
     * @return Collection|Jardinier[]
     */
    public function getJardiniers(): Collection
    {
        return parent::getJardiniers();
    }

    /**
     * @return Collection|Legume[]
     */
    public function getLegumes(): Collection
    {
        return $this->legumes;
    }

    public function addLegume(Legume $legume): self
    {
        if ($this->legumes->contains($legume)) {
           return $this; 
        }
        $this->legumes[] = $legume;
        $legume->addFleur($this);
        return $this;
    }

    public function removeLegume(Legume $legume): self
    {
        if (!$this->legumes->contains($legume)) {
           return $this; 
        }
        $this->legumes->removeElement($legume);
        $legume->removeFleur($this);
        return $this;
    }
}
