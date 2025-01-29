<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'equipes')]
    private ?tournoi $tournoi = null;

    #[ORM\ManyToOne(inversedBy: 'equipes')]
    private ?User $cree_par = null;

    /**
     * @var Collection<int, Joueur>
     */
    #[ORM\ManyToMany(targetEntity: Joueur::class, mappedBy: 'equipes')]
    private Collection $joueurs;

    /**
     * @var Collection<int, Rencontre>
     */
    #[ORM\OneToMany(targetEntity: Rencontre::class, mappedBy: 'equipe1')]
    private Collection $rencontres;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
        $this->rencontres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTournoi(): ?tournoi
    {
        return $this->tournoi;
    }

    public function setTournoi(?tournoi $tournoi): static
    {
        $this->tournoi = $tournoi;

        return $this;
    }

    public function getCreePar(): ?User
    {
        return $this->cree_par;
    }

    public function setCreePar(?User $cree_par): static
    {
        $this->cree_par = $cree_par;

        return $this;
    }

    /**
     * @return Collection<int, Joueur>
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): static
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs->add($joueur);
            $joueur->addEquipe($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): static
    {
        if ($this->joueurs->removeElement($joueur)) {
            $joueur->removeEquipe($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Rencontre>
     */
    public function getRencontres(): Collection
    {
        return $this->rencontres;
    }

    public function addRencontre(Rencontre $rencontre): static
    {
        if (!$this->rencontres->contains($rencontre)) {
            $this->rencontres->add($rencontre);
            $rencontre->setEquipe1($this);
        }

        return $this;
    }

    public function removeRencontre(Rencontre $rencontre): static
    {
        if ($this->rencontres->removeElement($rencontre)) {
            // set the owning side to null (unless already changed)
            if ($rencontre->getEquipe1() === $this) {
                $rencontre->setEquipe1(null);
            }
        }

        return $this;
    }
}
