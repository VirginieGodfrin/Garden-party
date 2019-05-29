<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\MappedSuperclassBase;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DecomposeurRepository")
 */
class Decomposeur extends MappedSuperclassBase
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
    private $debris;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebris(): ?string
    {
        return $this->debris;
    }

    public function setDebris(string $debris): self
    {
        $this->debris = $debris;

        return $this;
    }
}
