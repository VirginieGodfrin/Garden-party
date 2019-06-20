<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Fruit;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MangeurRepository")
 */
class Mangeur extends User
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
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vegetal", mappedBy="mangeur")
     */
    private $vegetals;

    public function __construct()
    {
        $this->fruits = new ArrayCollection();
        // $this->vegetals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return parent::getId();
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Vegetal[]
     */
    public function getVegetals(): Collection
    {
        return $this->vegetals;
    }

    public function addVegetal(Vegetal $vegetal): self
    {
        if (!$this->vegetals->contains($vegetal)) {
            $this->vegetals[] = $vegetal;
            $vegetal->setMangeur($this);
        }

        return $this;
    }

    public function removeVegetal(Vegetal $vegetal): self
    {
        if ($this->vegetals->contains($vegetal)) {
            $this->vegetals->removeElement($vegetal);
            // set the owning side to null (unless already changed)
            if ($vegetal->getMangeur() === $this) {
                $vegetal->setMangeur(null);
            }
        }

        return $this;
    }

    public function getClassName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}
