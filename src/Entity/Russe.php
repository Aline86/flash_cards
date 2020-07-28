<?php

namespace App\Entity;

use App\Repository\RusseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=RusseRepository::class)
 */
class Russe
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
    private $fr;

    const LANG = 'RUSSE';
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ru;

    /**
     * @ORM\ManyToOne(targetEntity=Theme::class, inversedBy="titre")
     */
    private $theme;

    

    

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFr(): ?string
    {
        return $this->fr;
    }

    public function setFr(string $fr): self
    {
        $this->fr = $fr;

        return $this;
    }

    public function getRu(): ?string
    {
        return $this->ru;
    }

    public function setRu(string $ru): self
    {
        $this->ru = $ru;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    
    

    

   
}
