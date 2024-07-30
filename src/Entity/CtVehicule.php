<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtVehicule
 *
 * @ORM\Table(name="ct_vehicule", indexes={@ORM\Index(name="fk_ct_vehicule_ct_marque1_idx", columns={"ct_marque_id"}), @ORM\Index(name="fk_ct_vehicule_ct_genre1_idx", columns={"ct_genre_id"})})
 * @ORM\Entity
 */
class CtVehicule
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
     * @ORM\Column(name="vhc_cylindre", type="string", length=10, nullable=true)
     */
    private $vhcCylindre;

    /**
     * @var float|null
     *
     * @ORM\Column(name="vhc_puissance", type="float", precision=10, scale=0, nullable=true)
     */
    private $vhcPuissance;

    /**
     * @var float|null
     *
     * @ORM\Column(name="vhc_poids_vide", type="float", precision=10, scale=0, nullable=true)
     */
    private $vhcPoidsVide;

    /**
     * @var float|null
     *
     * @ORM\Column(name="vhc_charge_utile", type="float", precision=10, scale=0, nullable=true)
     */
    private $vhcChargeUtile;

    /**
     * @var float|null
     *
     * @ORM\Column(name="vhc_hauteur", type="float", precision=10, scale=0, nullable=true)
     */
    private $vhcHauteur;

    /**
     * @var float|null
     *
     * @ORM\Column(name="vhc_largeur", type="float", precision=10, scale=0, nullable=true)
     */
    private $vhcLargeur;

    /**
     * @var float|null
     *
     * @ORM\Column(name="vhc_longueur", type="float", precision=10, scale=0, nullable=true)
     */
    private $vhcLongueur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vhc_num_serie", type="string", length=100, nullable=true)
     */
    private $vhcNumSerie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vhc_num_moteur", type="string", length=100, nullable=true)
     */
    private $vhcNumMoteur;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="vhc_created", type="datetime", nullable=true)
     */
    private $vhcCreated;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vhc_provenance", type="string", length=45, nullable=true)
     */
    private $vhcProvenance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vhc_type", type="string", length=45, nullable=true)
     */
    private $vhcType;

    /**
     * @var float|null
     *
     * @ORM\Column(name="vhc_poids_total_charge", type="float", precision=10, scale=0, nullable=true)
     */
    private $vhcPoidsTotalCharge;

    /**
     * @var \CtMarque
     *
     * @ORM\ManyToOne(targetEntity="CtMarque")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_marque_id", referencedColumnName="id")
     * })
     */
    private $ctMarque;

    /**
     * @var \CtGenre
     *
     * @ORM\ManyToOne(targetEntity="CtGenre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_genre_id", referencedColumnName="id")
     * })
     */
    private $ctGenre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVhcCylindre(): ?string
    {
        return $this->vhcCylindre;
    }

    public function setVhcCylindre(?string $vhcCylindre): self
    {
        $this->vhcCylindre = $vhcCylindre;

        return $this;
    }

    public function getVhcPuissance(): ?float
    {
        return $this->vhcPuissance;
    }

    public function setVhcPuissance(?float $vhcPuissance): self
    {
        $this->vhcPuissance = $vhcPuissance;

        return $this;
    }

    public function getVhcPoidsVide(): ?float
    {
        return $this->vhcPoidsVide;
    }

    public function setVhcPoidsVide(?float $vhcPoidsVide): self
    {
        $this->vhcPoidsVide = $vhcPoidsVide;

        return $this;
    }

    public function getVhcChargeUtile(): ?float
    {
        return $this->vhcChargeUtile;
    }

    public function setVhcChargeUtile(?float $vhcChargeUtile): self
    {
        $this->vhcChargeUtile = $vhcChargeUtile;

        return $this;
    }

    public function getVhcHauteur(): ?float
    {
        return $this->vhcHauteur;
    }

    public function setVhcHauteur(?float $vhcHauteur): self
    {
        $this->vhcHauteur = $vhcHauteur;

        return $this;
    }

    public function getVhcLargeur(): ?float
    {
        return $this->vhcLargeur;
    }

    public function setVhcLargeur(?float $vhcLargeur): self
    {
        $this->vhcLargeur = $vhcLargeur;

        return $this;
    }

    public function getVhcLongueur(): ?float
    {
        return $this->vhcLongueur;
    }

    public function setVhcLongueur(?float $vhcLongueur): self
    {
        $this->vhcLongueur = $vhcLongueur;

        return $this;
    }

    public function getVhcNumSerie(): ?string
    {
        return $this->vhcNumSerie;
    }

    public function setVhcNumSerie(?string $vhcNumSerie): self
    {
        $this->vhcNumSerie = $vhcNumSerie;

        return $this;
    }

    public function getVhcNumMoteur(): ?string
    {
        return $this->vhcNumMoteur;
    }

    public function setVhcNumMoteur(?string $vhcNumMoteur): self
    {
        $this->vhcNumMoteur = $vhcNumMoteur;

        return $this;
    }

    public function getVhcCreated(): ?\DateTimeInterface
    {
        return $this->vhcCreated;
    }

    public function setVhcCreated(?\DateTimeInterface $vhcCreated): self
    {
        $this->vhcCreated = $vhcCreated;

        return $this;
    }

    public function getVhcProvenance(): ?string
    {
        return $this->vhcProvenance;
    }

    public function setVhcProvenance(?string $vhcProvenance): self
    {
        $this->vhcProvenance = $vhcProvenance;

        return $this;
    }

    public function getVhcType(): ?string
    {
        return $this->vhcType;
    }

    public function setVhcType(?string $vhcType): self
    {
        $this->vhcType = $vhcType;

        return $this;
    }

    public function getVhcPoidsTotalCharge(): ?float
    {
        return $this->vhcPoidsTotalCharge;
    }

    public function setVhcPoidsTotalCharge(?float $vhcPoidsTotalCharge): self
    {
        $this->vhcPoidsTotalCharge = $vhcPoidsTotalCharge;

        return $this;
    }

    public function getCtMarque(): ?CtMarque
    {
        return $this->ctMarque;
    }

    public function setCtMarque(?CtMarque $ctMarque): self
    {
        $this->ctMarque = $ctMarque;

        return $this;
    }

    public function getCtGenre(): ?CtGenre
    {
        return $this->ctGenre;
    }

    public function setCtGenre(?CtGenre $ctGenre): self
    {
        $this->ctGenre = $ctGenre;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getVhcNumSerie();
    }


}
