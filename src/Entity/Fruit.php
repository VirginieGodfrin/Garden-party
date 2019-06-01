<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    public function getId(): ?int
    {
        return $this->id;
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
}
