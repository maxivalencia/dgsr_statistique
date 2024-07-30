<?php

namespace App\Entity;

use App\Entity\CtUser;
use App\Entity\CtCentre;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use DateTimeInterface;

/**
 * CtConstAvDed
 *
 * @ORM\Table(name="ct_const_av_ded", indexes={@ORM\Index(name="fk_ct_const_av_ded_ct_user1_idx", columns={"ct_verificateur_id"}), @ORM\Index(name="fk_ct_const_av_ded_ct_centre1_idx", columns={"ct_centre_id"})})
 * @ORM\Entity
 */
class CtConstAvDed
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_provenance", type="string", length=45, nullable=true)
     */
    private $cadProvenance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_divers", type="string", length=100, nullable=true)
     */
    private $cadDivers;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_proprietaire_nom", type="string", length=100, nullable=true)
     */
    private $cadProprietaireNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_proprietaire_adresse", type="string", length=100, nullable=true)
     */
    private $cadProprietaireAdresse;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cad_bon_etat", type="boolean", nullable=true)
     */
    private $cadBonEtat;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cad_sec_pers", type="boolean", nullable=true)
     */
    private $cadSecPers;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cad_sec_march", type="boolean", nullable=true)
     */
    private $cadSecMarch;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cad_protec_env", type="boolean", nullable=true)
     */
    private $cadProtecEnv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_numero", type="string", length=45, nullable=true)
     */
    private $cadNumer;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_immatriculation", type="string", length=45, nullable=true)
     */
    private $cadImmatriculation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cad_date_embarquement", type="datetime", nullable=true)
     */
    private $cadDateEmbarquement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_lieu_embarquement", type="string", length=45, nullable=true)
     */
    private $cadLieuEmbarquement;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cad_created", type="datetime", nullable=true)
     */
    private $cadCreated;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="cad_conforme", type="boolean", nullable=true)
     */
    private $cadConforme;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_observation", type="string", length=255, nullable=true)
     */
    private $cadObservation;

    /**
     * @var \CtCentre
     *
     * @ORM\ManyToOne(targetEntity="CtCentre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_centre_id", referencedColumnName="id")
     * })
     */
    private $ctCentre;

    /**
     * @var \CtUser
     *
     * @ORM\ManyToOne(targetEntity="CtUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_verificateur_id", referencedColumnName="id")
     * })
     */
    private $ctVerificateur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CtConstAvDedCarac", inversedBy="constAvDed")
     * @ORM\JoinTable(name="ct_const_av_deds_const_av_ded_caracs",
     *   joinColumns={
     *     @ORM\JoinColumn(name="const_av_ded_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="const_av_ded_carac_id", referencedColumnName="id")
     *   }
     * )
     */
    private $constAvDedCarac;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->constAvDedCarac = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCadProvenance(): ?string
    {
        return $this->cadProvenance;
    }

    public function setCadProvenance(?string $cadProvenance): self
    {
        $this->cadProvenance = $cadProvenance;

        return $this;
    }

    public function getCadDivers(): ?string
    {
        return $this->cadDivers;
    }

    public function setCadDivers(?string $cadDivers): self
    {
        $this->cadDivers = $cadDivers;

        return $this;
    }

    public function getCadProprietaireNom(): ?string
    {
        return $this->cadProprietaireNom;
    }

    public function setCadProprietaireNom(?string $cadProprietaireNom): self
    {
        $this->cadProprietaireNom = $cadProprietaireNom;

        return $this;
    }

    public function getCadProprietaireAdresse(): ?string
    {
        return $this->cadProprietaireAdresse;
    }

    public function setCadProprietaireAdresse(?string $cadProprietaireAdresse): self
    {
        $this->cadProprietaireAdresse = $cadProprietaireAdresse;

        return $this;
    }

    public function getCadBonEtat(): ?bool
    {
        return $this->cadBonEtat;
    }

    public function setCadBonEtat(?bool $cadBonEtat): self
    {
        $this->cadBonEtat = $cadBonEtat;

        return $this;
    }

    public function getCadSecPers(): ?bool
    {
        return $this->cadSecPers;
    }

    public function setCadSecPers(?bool $cadSecPers): self
    {
        $this->cadSecPers = $cadSecPers;

        return $this;
    }

    public function getCadSecMarch(): ?bool
    {
        return $this->cadSecMarch;
    }

    public function setCadSecMarch(?bool $cadSecMarch): self
    {
        $this->cadSecMarch = $cadSecMarch;

        return $this;
    }

    public function getCadProtecEnv(): ?bool
    {
        return $this->cadProtecEnv;
    }

    public function setCadProtecEnv(?bool $cadProtecEnv): self
    {
        $this->cadProtecEnv = $cadProtecEnv;

        return $this;
    }

    public function getCadNumero(): ?string
    {
        return $this->cadNumero;
    }

    public function setCadNumero(?string $cadNumero): self
    {
        $this->cadNumero = $cadNumero;

        return $this;
    }

    public function getCadImmatriculation(): ?string
    {
        return $this->cadImmatriculation;
    }

    public function setCadImmatriculation(?string $cadImmatriculation): self
    {
        $this->cadImmatriculation = $cadImmatriculation;

        return $this;
    }

    public function getCadDateEmbarquement(): ?\DateTimeInterface
    {
        return $this->cadDateEmbarquement;
    }

    public function setCadDateEmbarquement(?\DateTimeInterface $cadDateEmbarquement): self
    {
        $this->cadDateEmbarquement = $cadDateEmbarquement;

        return $this;
    }

    public function getCadLieuEmbarquement(): ?string
    {
        return $this->cadLieuEmbarquement;
    }

    public function setCadLieuEmbarquement(?string $cadLieuEmbarquement): self
    {
        $this->cadLieuEmbarquement = $cadLieuEmbarquement;

        return $this;
    }

    public function getCadCreated(): ?\DateTimeInterface
    {
        return $this->cadCreated;
    }

    public function setCadCreated(?\DateTimeInterface $cadCreated): self
    {
        $this->cadCreated = $cadCreated;

        return $this;
    }

    public function getCadConforme(): ?bool
    {
        return $this->cadConforme;
    }

    public function setCadConforme(?bool $cadConforme): self
    {
        $this->cadConforme = $cadConforme;

        return $this;
    }

    public function getCadObservation(): ?string
    {
        return $this->cadObservation;
    }

    public function setCadObservation(?string $cadObservation): self
    {
        $this->cadObservation = $cadObservation;

        return $this;
    }

    public function getCtCentre(): ?CtCentre
    {
        return $this->ctCentre;
    }

    public function setCtCentre(?CtCentre $ctCentre): self
    {
        $this->ctCentre = $ctCentre;

        return $this;
    }

    public function getCtVerificateur(): ?CtUser
    {
        return $this->ctVerificateur;
    }

    public function setCtVerificateur(?CtUser $ctVerificateur): self
    {
        $this->ctVerificateur = $ctVerificateur;

        return $this;
    }

    /**
     * @return Collection|CtConstAvDedCarac[]
     */
    public function getConstAvDedCarac(): Collection
    {
        return $this->constAvDedCarac;
    }

    public function addConstAvDedCarac(CtConstAvDedCarac $constAvDedCarac): self
    {
        if (!$this->constAvDedCarac->contains($constAvDedCarac)) {
            $this->constAvDedCarac[] = $constAvDedCarac;
        }

        return $this;
    }

    public function removeConstAvDedCarac(CtConstAvDedCarac $constAvDedCarac): self
    {
        if ($this->constAvDedCarac->contains($constAvDedCarac)) {
            $this->constAvDedCarac->removeElement($constAvDedCarac);
        }

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCadNumero();
    }

}
