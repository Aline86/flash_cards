<?php

namespace App\Entity;

use App\Repository\PolonaisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PolonaisRepository::class)
 */
class Polonais
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    const LANG = 'POLONAIS';
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pl;

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

    public function getPl(): ?string
    {
        return $this->pl;
    }

    public function setPl(string $pl): self
    {
        $this->pl = $pl;

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
