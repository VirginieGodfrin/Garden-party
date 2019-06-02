<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Mangeur;

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

    public function getMangeurs(): ?Mangeur
    {
        return parent::getMangeurs();
    }
}
