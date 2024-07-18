<?php

namespace App\Entity;

use App\Repository\LicenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LicenceRepository::class)]
class Licence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'licences')]
    private ?Categorie $code_categorie = null;

    #[ORM\ManyToOne(inversedBy: 'licences')]
    private ?User $code_moniteur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_obtention = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCategorie(): ?Categorie
    {
        return $this->code_categorie;
    }

    public function setCodeCategorie(?Categorie $code_categorie): static
    {
        $this->code_categorie = $code_categorie;

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

    public function getDateObtention(): ?\DateTimeInterface
    {
        return $this->date_obtention;
    }

    public function setDateObtention(?\DateTimeInterface $date_obtention): static
    {
        $this->date_obtention = $date_obtention;

        return $this;
    }
}
