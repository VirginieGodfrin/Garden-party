<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
class MappedSuperclassBase
{
    /** 
     * @ORM\Column(type="string")
     */
    protected $name;

    /** 
     * @ORM\Column(type="string")
     */
    protected $description;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

}