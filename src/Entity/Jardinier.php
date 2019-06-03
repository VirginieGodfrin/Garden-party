<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Vegetal;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JardinierRepository")
 */
class Jardinier extends User
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
    private $outil;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mission;

    /**
     * @ORM\ManyToMany(targetEntity="Vegetal", inversedBy="jardiniers")
     */
    private $vegetals;

    public function __construct()
    {
        $this->vegetals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOutil(): ?string
    {
        return $this->outil;
    }

    public function setOutil(string $outil): self
    {
        $this->outil = $outil;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): self
    {
        $this->mission = $mission;

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
        }

        return $this;
    }

    public function removeVegetal(Vegetal $vegetal): self
    {
        if ($this->vegetals->contains($vegetal)) {
            $this->vegetals->removeElement($vegetal);
        }

        return $this;
    }

}
