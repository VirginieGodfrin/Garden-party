<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\MappedSuperclassBase;
use App\Entity\Pollinisateur;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PollinisateurRepository")
 */
class Pollinisateur extends MappedSuperclassBase
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
    private $fleur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFleur(): ?string
    {
        return $this->fleur;
    }

    public function setFleur(string $fleur): self
    {
        $this->fleur = $fleur;

        return $this;
    }
}
