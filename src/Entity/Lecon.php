<?php

namespace App\Entity;

use App\Repository\LeconRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeconRepository::class)]
class Lecon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;




    #[ORM\Column(nullable: true)]
    private ?bool $reglee = null;

    #[ORM\ManyToOne(inversedBy: 'lecons')]
    private ?User $code_moniteur = null;

    #[ORM\ManyToOne(inversedBy: 'lecons')]
    private ?User $code_eleve = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $rdv = null;

    #[ORM\ManyToOne(inversedBy: 'lecons')]
    private ?Vehicule $immatriculation = null;

    public function getId(): ?int
    {
        return $this->id;
    }




    public function isReglee(): ?bool
    {
        return $this->reglee;
    }

    public function setReglee(?bool $reglee): static
    {
        $this->reglee = $reglee;

        return $this;
    }

    public function getCodeMoniteur(): ?User
    {
        return $this->code_moniteur;
    }

    public function setCodeMoniteur(?User $code_moniteur): static
    {
        $this->code_moniteur = $code_moniteur;

        return $this;
    }

    public function getCodeEleve(): ?User
    {
        return $this->code_eleve;
    }

    public function setCodeEleve(?User $code_eleve): static
    {
        $this->code_eleve = $code_eleve;

        return $this;
    }

    public function getRdv(): ?\DateTimeInterface
    {
        return $this->rdv;
    }

    public function setRdv(?\DateTimeInterface $rdv): static
    {
        $this->rdv = $rdv;

        return $this;
    }

    public function getImmatriculation(): ?Vehicule
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(?Vehicule $immatriculation): static
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }
}
