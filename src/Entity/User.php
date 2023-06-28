<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire_user = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire_admin = null;

    #[ORM\Column(length: 50)]
    private ?string $telephone = null;

    // #[ORM\OneToMany(mappedBy: 'user', targetEntity: Note::class, orphanRemoval: true)]
    // private Collection $notes;

    #[ORM\ManyToMany(targetEntity: Regime::class)]
    private Collection $regime;

    #[ORM\ManyToMany(targetEntity: Allergene::class)]
    private Collection $allergene;

    #[ORM\Column]
    private ?bool $est_client = null;

    public function __construct()
    {
        // $this->notes = new ArrayCollection();
        $this->regime = new ArrayCollection();
        $this->allergene = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCommentaireUser(): ?string
    {
        return $this->commentaire_user;
    }

    public function setCommentaireUser(?string $commentaire_user): self
    {
        $this->commentaire_user = $commentaire_user;

        return $this;
    }

    public function getCommentaireAdmin(): ?string
    {
        return $this->commentaire_admin;
    }

    public function setCommentaireAdmin(?string $commentaire_admin): self
    {
        $this->commentaire_admin = $commentaire_admin;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    // /**
    //  * @return Collection<int, Note>
    //  */
    // public function getNotes(): Collection
    // {
    //     return $this->notes;
    // }

    // public function addNote(Note $note): self
    // {
    //     if (!$this->notes->contains($note)) {
    //         $this->notes->add($note);
    //         $note->setUser($this);
    //     }

    //     return $this;
    // }

    // public function removeNote(Note $note): self
    // {
    //     if ($this->notes->removeElement($note)) {
    //         // set the owning side to null (unless already changed)
    //         if ($note->getUser() === $this) {
    //             $note->setUser(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, regime>
     */
    public function getRegime(): Collection
    {
        return $this->regime;
    }

    public function addRegime(Regime $regime): self
    {
        if (!$this->regime->contains($regime)) {
            $this->regime->add($regime);
        }

        return $this;
    }

    public function removeRegime(Regime $regime): self
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

    public function addAllergene(Allergene $allergene): self
    {
        if (!$this->allergene->contains($allergene)) {
            $this->allergene->add($allergene);
        }

        return $this;
    }

    public function removeAllergene(Allergene $allergene): self
    {
        $this->allergene->removeElement($allergene);

        return $this;
    }

    public function isEstClient(): ?bool
    {
        return $this->est_client;
    }

    public function setEstClient(bool $est_client): self
    {
        $this->est_client = $est_client;

        return $this;
    }
}
