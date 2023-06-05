<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $temps_preparation = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $temps_repos = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $temps_cuisson = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $ingredients = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $preparation = null;

    #[ORM\Column]
    private ?bool $visible_tous = null;

    #[ORM\ManyToMany(targetEntity: regime::class)]
    private Collection $regime;

    #[ORM\ManyToMany(targetEntity: allergene::class)]
    private Collection $allergene;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Note::class, orphanRemoval: true)]
    private Collection $notes;

    public function __construct()
    {
        $this->regime = new ArrayCollection();
        $this->allergene = new ArrayCollection();
        $this->notes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTempsPreparation(): ?\DateTimeInterface
    {
        return $this->temps_preparation;
    }

    public function setTempsPreparation(?\DateTimeInterface $temps_preparation): self
    {
        $this->temps_preparation = $temps_preparation;

        return $this;
    }

    public function getTempsRepos(): ?\DateTimeInterface
    {
        return $this->temps_repos;
    }

    public function setTempsRepos(?\DateTimeInterface $temps_repos): self
    {
        $this->temps_repos = $temps_repos;

        return $this;
    }

    public function getTempsCuisson(): ?\DateTimeInterface
    {
        return $this->temps_cuisson;
    }

    public function setTempsCuisson(?\DateTimeInterface $temps_cuisson): self
    {
        $this->temps_cuisson = $temps_cuisson;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): self
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function isVisibleTous(): ?bool
    {
        return $this->visible_tous;
    }

    public function setVisibleTous(bool $visible_tous): self
    {
        $this->visible_tous = $visible_tous;

        return $this;
    }

    /**
     * @return Collection<int, regime>
     */
    public function getRegime(): Collection
    {
        return $this->regime;
    }

    public function addRegime(regime $regime): self
    {
        if (!$this->regime->contains($regime)) {
            $this->regime->add($regime);
        }

        return $this;
    }

    public function removeRegime(regime $regime): self
    {
        $this->regime->removeElement($regime);

        return $this;
    }

    /**
     * @return Collection<int, allergene>
     */
    public function getAllergene(): Collection
    {
        return $this->allergene;
    }

    public function addAllergene(allergene $allergene): self
    {
        if (!$this->allergene->contains($allergene)) {
            $this->allergene->add($allergene);
        }

        return $this;
    }

    public function removeAllergene(allergene $allergene): self
    {
        $this->allergene->removeElement($allergene);

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setRecette($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getRecette() === $this) {
                $note->setRecette(null);
            }
        }

        return $this;
    }
}
