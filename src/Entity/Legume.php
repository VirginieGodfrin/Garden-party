<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LegumeRepository")
 */
class Legume extends Vegetal
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
    private $taille;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $soupe;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fleur", inversedBy="legumes")
     */
    private $fleurs;

    public function __construct()
    {
        parent::__construct();
        $this->fleurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return parent::getId();
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getSoupe(): ?string
    {
        return $this->soupe;
    }

    public function setSoupe(?string $soupe): self
    {
        $this->soupe = $soupe;

        return $this;
    }


    public function getClassName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    /**
     * @return Collection|Fleur[]
     */
    public function getFleurs(): Collection
    {
        return $this->fleurs;
    }

    public function addFleur(Fleur $fleur): self
    {
        if (!$this->fleurs->contains($fleur)) {
            $this->fleurs[] = $fleur;
        }

        return $this;
    }

    public function removeFleur(Fleur $fleur): self
    {
        if ($this->fleurs->contains($fleur)) {
            $this->fleurs->removeElement($fleur);
        }

        return $this;
    }
}
