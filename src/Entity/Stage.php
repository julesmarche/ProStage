<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StageRepository::class)
 */
class Stage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $descriptionMissions;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $emailContact;

    /**
     * @ORM\ManyToMany(targetEntity=Formation::class, inversedBy="stages")
     */
    private $typeFormation;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="stages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    public function __construct()
    {
        $this->typeFormation = new ArrayCollection();
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

    public function getDescriptionMissions(): ?string
    {
        return $this->descriptionMissions;
    }

    public function setDescriptionMissions(string $descriptionMissions): self
    {
        $this->descriptionMissions = $descriptionMissions;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getTypeFormation(): Collection
    {
        return $this->typeFormation;
    }

    public function addTypeFormation(Formation $typeFormation): self
    {
        if (!$this->typeFormation->contains($typeFormation)) {
            $this->typeFormation[] = $typeFormation;
        }

        return $this;
    }

    public function removeTypeFormation(Formation $typeFormation): self
    {
        $this->typeFormation->removeElement($typeFormation);

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
