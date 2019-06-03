<?php

namespace App\Entity;

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
}
