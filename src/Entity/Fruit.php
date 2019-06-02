<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Mangeur;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FruitRepository")
 */
class Fruit extends Vegetal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $arbre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $salade;

    /**
     * @ORM\OneToMany(targetEntity="Mangeur", mappedBy="fruits")
     */
    private $mangeurs;

    public function __construct()
    {
        $this->mangeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return parent::getId();
    }

    public function getArbre(): ?string
    {
        return $this->arbre;
    }

    public function setArbre(string $arbre): self
    {
        $this->arbre = $arbre;

        return $this;
    }

    public function getSalade(): ?string
    {
        return $this->salade;
    }

    public function setSalade(?string $salade): self
    {
        $this->salade = $salade;

        return $this;
    }

    /**
     * @return Collection|Mangeur[]
     */
    public function getMangeurs(): Collection
    {
        return $this->mangeurs;
    }

    public function addMangeur(Mangeur $mangeur): self
    {
        if (!$this->mangeurs->contains($mangeur)) {
            $this->mangeurs[] = $mangeur;
            $mangeur->setFruits($this);
        }

        return $this;
    }

    public function removeMangeur(Mangeur $mangeur): self
    {
        if ($this->mangeurs->contains($mangeur)) {
            $this->mangeurs->removeElement($mangeur);
            // set the owning side to null (unless already changed)
            if ($mangeur->getFruits() === $this) {
                $mangeur->setFruits(null);
            }
        }

        return $this;
    }
}
