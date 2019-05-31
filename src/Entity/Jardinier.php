<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
