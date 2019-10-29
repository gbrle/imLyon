<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SousCategorie", mappedBy="categorie", orphanRemoval=true)
     */
    private $sous_categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DemainWeArt", inversedBy="categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $demainWeArt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleurFooter;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $backgroundImage;

    public function __construct()
    {
        $this->sous_categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection|SousCategorie[]
     */
    public function getSousCategorie(): Collection
    {
        return $this->sous_categorie;
    }

    public function addSousCategorie(SousCategorie $sousCategorie): self
    {
        if (!$this->sous_categorie->contains($sousCategorie)) {
            $this->sous_categorie[] = $sousCategorie;
            $sousCategorie->setCategorie($this);
        }

        return $this;
    }

    public function removeSousCategorie(SousCategorie $sousCategorie): self
    {
        if ($this->sous_categorie->contains($sousCategorie)) {
            $this->sous_categorie->removeElement($sousCategorie);
            // set the owning side to null (unless already changed)
            if ($sousCategorie->getCategorie() === $this) {
                $sousCategorie->setCategorie(null);
            }
        }

        return $this;
    }

    public function getDemainWeArt(): ?DemainWeArt
    {
        return $this->demainWeArt;
    }

    public function setDemainWeArt(?DemainWeArt $demainWeArt): self
    {
        $this->demainWeArt = $demainWeArt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCouleurFooter(): ?string
    {
        return $this->couleurFooter;
    }

    public function setCouleurFooter(?string $couleurFooter): self
    {
        $this->couleurFooter = $couleurFooter;

        return $this;
    }

    public function getBackgroundImage(): ?string
    {
        return $this->backgroundImage;
    }

    public function setBackgroundImage(?string $backgroundImage): self
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }
}
