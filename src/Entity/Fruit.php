<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Mangeur;
use App\Entity\Arbre;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $salade;

    /**
     * @ORM\ManyToOne(targetEntity="Arbre", inversedBy="fruits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arbre;

    public function __construct()
    {
        parent::__construct();
        $this->arbres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return parent::getId();
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

    public function getClassName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    public function getArbre(): ?Arbre
    {
        return $this->arbre;
    }

    public function setArbre(?Arbre $arbre): self
    {
        $this->arbre = $arbre;

        return $this;
    }

}
