<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Fruit;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArbreRepository")
 */
class Arbre extends Vegetal
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="Fruit", mappedBy="arbre")
     */
    private $fruits;

    public function __construct()
    {
        $this->fruits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return parent::getId();
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Fruit[]
     */
    public function getFruits(): Collection
    {
        return $this->fruits;
    }

    public function addFruit(Fruit $fruit): self
    {
        if (!$this->fruits->contains($fruit)) {
            $this->fruits[] = $fruit;
            $fruit->setArbre($this);
        }

        return $this;
    }

    public function removeFruit(Fruit $fruit): self
    {
        if ($this->fruits->contains($fruit)) {
            $this->fruits->removeElement($fruit);
            // set the owning side to null (unless already changed)
            if ($fruit->getArbre() === $this) {
                $fruit->setArbre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Jardinier[]
     */
    public function getJardiniers(): Collection
    {
        return parent::getJardiniers();
    }
}
