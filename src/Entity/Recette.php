<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
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
}
