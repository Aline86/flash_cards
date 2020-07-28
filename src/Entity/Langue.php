<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LangueRepository::class)
 */
class Langue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\OneToMany(targetEntity=Theme::class, mappedBy="langue")
     */

    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

   

    /**
     * @ORM\OneToMany(targetEntity=Theme::class, mappedBy="langue")
     */
    private $langue;

    public function __construct()
    {
        $this->libelle = new ArrayCollection();
        $this->langue = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function addLibelle(Theme $libelle): self
    {
        if (!$this->libelle->contains($libelle)) {
            $this->libelle[] = $libelle;
            $libelle->setLangue($this);
        }

        return $this;
    }

    public function removeLibelle(Theme $libelle): self
    {
        if ($this->libelle->contains($libelle)) {
            $this->libelle->removeElement($libelle);
            // set the owning side to null (unless already changed)
            if ($libelle->getLangue() === $this) {
                $libelle->setLangue(null);
            }
        }

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Theme[]
     */
    public function getLangue(): Collection
    {
        return $this->langue;
    }

    public function addLangue(Theme $langue): self
    {
        if (!$this->langue->contains($langue)) {
            $this->langue[] = $langue;
            $langue->setLibelle($this);
        }

        return $this;
    }

    public function removeLangue(Theme $langue): self
    {
        if ($this->langue->contains($langue)) {
            $this->langue->removeElement($langue);
            // set the owning side to null (unless already changed)
            if ($langue->getTitre() === $this) {
                $langue->setTitre(null);
            }
        }

        return $this;
    }
    public function __toString()
{
    return  $this->libelle;
}
}
