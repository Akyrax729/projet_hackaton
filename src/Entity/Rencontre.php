<?php

namespace App\Entity;

use App\Repository\RencontreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RencontreRepository::class)]
class Rencontre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tournoi $tournoi = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres1')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipe $equipe1 = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres2')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipe $equipe2 = null;

    #[ORM\Column(type: Types::SMALLINT, options: ['default' => 0])]
    private ?int $score1 = 0;

    #[ORM\Column(type: Types::SMALLINT, options: ['default' => 0])]
    private ?int $score2 = 0;

    public const STATUS_PENDING = 'En attente';
    public const STATUS_IN_PROGRESS = 'En cours';
    public const STATUS_FINISHED = 'Terminé';

    #[ORM\Column(length: 255)]
    private ?string $statut = self::STATUS_PENDING; // Statut par défaut

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTournoi(): ?Tournoi
    {
        return $this->tournoi;
    }

    public function setTournoi(?Tournoi $tournoi): static
    {
        $this->tournoi = $tournoi;
        return $this;
    }

    public function getEquipe1(): ?Equipe
    {
        return $this->equipe1;
    }

    public function setEquipe1(?Equipe $equipe1): static
    {
        $this->equipe1 = $equipe1;
        return $this;
    }

    public function getEquipe2(): ?Equipe
    {
        return $this->equipe2;
    }

    public function setEquipe2(?Equipe $equipe2): static
    {
        $this->equipe2 = $equipe2;
        return $this;
    }

    public function getScore1(): ?int
    {
        return $this->score1;
    }

    public function setScore1(int $score1): static
    {
        $this->score1 = $score1;
        return $this;
    }

    public function getScore2(): ?int
    {
        return $this->score2;
    }

    public function setScore2(int $score2): static
    {
        $this->score2 = $score2;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        if (!in_array($statut, [self::STATUS_PENDING, self::STATUS_IN_PROGRESS, self::STATUS_FINISHED])) {
            throw new \InvalidArgumentException("Statut invalide");
        }
        $this->statut = $statut;
        return $this;
    }
}
