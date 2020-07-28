<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThemeRepository::class)
 */
class Theme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Russe::class, mappedBy="theme")
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $theme;

    /**
     * @ORM\ManyToOne(targetEntity=Langue::class, inversedBy="Id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $langue;

    public function __construct()
    {
        $this->titre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Russe[]
     * @return Collection|Polonais[]
     * @return Collection|Allemand[]
     * @return Collection|Espagnol[]
     */
    public function getTitre(): Collection
    {
        return $this->titre;
    }

    public function addTitre(Russe $titre): self
    {
        if (!$this->titre->contains($titre)) {
            $this->titre[] = $titre;
            $titre->setTheme($this);
        }

        return $this;
    }

    public function removeTitre(Russe $titre): self
    {
        if ($this->titre->contains($titre)) {
            $this->titre->removeElement($titre);
            // set the owning side to null (unless already changed)
            if ($titre->getTheme() === $this) {
                $titre->setTheme(null);
            }
        }

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
    public function __toString(){
        return $this->theme;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

}
