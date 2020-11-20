<?php

namespace App\Entity;

use App\Repository\PinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PinRepository::class)
 */
class Pin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\OneToMany(targetEntity=RendezVous::class, mappedBy="pin")
     */
    private $crenau_rdv;

    public function __construct()
    {
        $this->crenau_rdv = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * @return Collection|RendezVous[]
     */
    public function getCrenauRdv(): Collection
    {
        return $this->crenau_rdv;
    }

    public function addCrenauRdv(RendezVous $crenauRdv): self
    {
        if (!$this->crenau_rdv->contains($crenauRdv)) {
            $this->crenau_rdv[] = $crenauRdv;
            $crenauRdv->setPin($this);
        }

        return $this;
    }

    public function removeCrenauRdv(RendezVous $crenauRdv): self
    {
        if ($this->crenau_rdv->removeElement($crenauRdv)) {
            // set the owning side to null (unless already changed)
            if ($crenauRdv->getPin() === $this) {
                $crenauRdv->setPin(null);
            }
        }

        return $this;
    }
}
