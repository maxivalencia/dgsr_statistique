<?php

namespace App\Entity;

use App\Entity\CtGenre;
use App\Entity\CtMarque;
use App\Entity\CtCarosserie;
use App\Entity\CtConstAvDed;
use App\Entity\CtSourceEnergie;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CtConstAvDedCarac
 *
 * @ORM\Table(name="ct_const_av_ded_carac", indexes={@ORM\Index(name="fk_ct_const_av_ded_carac_ct_carosserie1_idx", columns={"ct_carosserie_id"}), @ORM\Index(name="fk_ct_const_av_ded_carac_ct_marque1_idx", columns={"ct_marque_id"}), @ORM\Index(name="fk_ct_const_av_ded_carac_ct_source_energie1_idx", columns={"ct_source_energie_id"}), @ORM\Index(name="fk_ct_const_av_ded_carac_ct_const_av_ded_type1_idx", columns={"ct_const_av_ded_type_id"}), @ORM\Index(name="fk_ct_const_av_ded_carac_ct_genre1_idx", columns={"ct_genre_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CtAvDedCaracRepository")
 */
class CtConstAvDedCarac
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
     * @ORM\Column(name="cad_cylindre", type="string", length=10, nullable=true)
     */
    private $cadCylindre;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cad_puissance", type="float", precision=10, scale=0, nullable=true)
     */
    private $cadPuissance;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cad_poids_vide", type="float", precision=10, scale=0, nullable=true)
     */
    private $cadPoidsVide;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cad_charge_utile", type="float", precision=10, scale=0, nullable=true)
     */
    private $cadChargeUtile;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cad_hauteur", type="float", precision=10, scale=0, nullable=true)
     */
    private $cadHauteur;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cad_largeur", type="float", precision=10, scale=0, nullable=true)
     */
    private $cadLargeur;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cad_longueur", type="float", precision=10, scale=0, nullable=true)
     */
    private $cadLongueur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_num_serie_type", type="string", length=100, nullable=true)
     */
    private $cadNumSerieType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_num_moteur", type="string", length=100, nullable=true)
     */
    private $cadNumMoteur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_type_car", type="string", length=45, nullable=true)
     */
    private $cadTypeCar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_poids_maxima", type="text", length=65535, nullable=true)
     */
    private $cadPoidsMaxima;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cad_poids_total_charge", type="float", precision=10, scale=0, nullable=true)
     */
    private $cadPoidsTotalCharge;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cad_premiere_circule", type="string", length=100, nullable=true)
     */
    private $cadPremiereCircule;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cad_nbr_assis", type="integer", nullable=true)
     */
    private $cadNbrAssis;

    /**
     * @var \CtSourceEnergie
     *
     * @ORM\ManyToOne(targetEntity="CtSourceEnergie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_source_energie_id", referencedColumnName="id")
     * })
     */
    private $ctSourceEnergie;

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
     * @var \CtConstAvDedType
     *
     * @ORM\ManyToOne(targetEntity="CtConstAvDedType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_const_av_ded_type_id", referencedColumnName="id")
     * })
     */
    private $ctConstAvDedType;

    /**
     * @var \CtGenre
     *
     * @ORM\ManyToOne(targetEntity="CtGenre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_genre_id", referencedColumnName="id")
     * })
     */
    private $ctGenre;

    /**
     * @var \CtCarosserie
     *
     * @ORM\ManyToOne(targetEntity="CtCarosserie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_carosserie_id", referencedColumnName="id")
     * })
     */
    private $ctCarosserie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CtConstAvDed", mappedBy="constAvDedCarac")
     */
    private $constAvDed;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->constAvDed = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCadCylindre(): ?string
    {
        return $this->cadCylindre;
    }

    public function setCadCylindre(?string $cadCylindre): self
    {
        $this->cadCylindre = $cadCylindre;

        return $this;
    }

    public function getCadPuissance(): ?float
    {
        return $this->cadPuissance;
    }

    public function setCadPuissance(?float $cadPuissance): self
    {
        $this->cadPuissance = $cadPuissance;

        return $this;
    }

    public function getCadPoidsVide(): ?float
    {
        return $this->cadPoidsVide;
    }

    public function setCadPoidsVide(?float $cadPoidsVide): self
    {
        $this->cadPoidsVide = $cadPoidsVide;

        return $this;
    }

    public function getCadChargeUtile(): ?float
    {
        return $this->cadChargeUtile;
    }

    public function setCadChargeUtile(?float $cadChargeUtile): self
    {
        $this->cadChargeUtile = $cadChargeUtile;

        return $this;
    }

    public function getCadHauteur(): ?float
    {
        return $this->cadHauteur;
    }

    public function setCadHauteur(?float $cadHauteur): self
    {
        $this->cadHauteur = $cadHauteur;

        return $this;
    }

    public function getCadLargeur(): ?float
    {
        return $this->cadLargeur;
    }

    public function setCadLargeur(?float $cadLargeur): self
    {
        $this->cadLargeur = $cadLargeur;

        return $this;
    }

    public function getCadLongueur(): ?float
    {
        return $this->cadLongueur;
    }

    public function setCadLongueur(?float $cadLongueur): self
    {
        $this->cadLongueur = $cadLongueur;

        return $this;
    }

    public function getCadNumSerieType(): ?string
    {
        return $this->cadNumSerieType;
    }

    public function setCadNumSerieType(?string $cadNumSerieType): self
    {
        $this->cadNumSerieType = $cadNumSerieType;

        return $this;
    }

    public function getCadNumMoteur(): ?string
    {
        return $this->cadNumMoteur;
    }

    public function setCadNumMoteur(?string $cadNumMoteur): self
    {
        $this->cadNumMoteur = $cadNumMoteur;

        return $this;
    }

    public function getCadTypeCar(): ?string
    {
        return $this->cadTypeCar;
    }

    public function setCadTypeCar(?string $cadTypeCar): self
    {
        $this->cadTypeCar = $cadTypeCar;

        return $this;
    }

    public function getCadPoidsMaxima(): ?string
    {
        return $this->cadPoidsMaxima;
    }

    public function setCadPoidsMaxima(?string $cadPoidsMaxima): self
    {
        $this->cadPoidsMaxima = $cadPoidsMaxima;

        return $this;
    }

    public function getCadPoidsTotalCharge(): ?float
    {
        return $this->cadPoidsTotalCharge;
    }

    public function setCadPoidsTotalCharge(?float $cadPoidsTotalCharge): self
    {
        $this->cadPoidsTotalCharge = $cadPoidsTotalCharge;

        return $this;
    }

    public function getCadPremiereCircule(): ?string
    {
        return $this->cadPremiereCircule;
    }

    public function setCadPremiereCircule(?string $cadPremiereCircule): self
    {
        $this->cadPremiereCircule = $cadPremiereCircule;

        return $this;
    }

    public function getCadNbrAssis(): ?int
    {
        return $this->cadNbrAssis;
    }

    public function setCadNbrAssis(?int $cadNbrAssis): self
    {
        $this->cadNbrAssis = $cadNbrAssis;

        return $this;
    }

    public function getCtSourceEnergie(): ?CtSourceEnergie
    {
        return $this->ctSourceEnergie;
    }

    public function setCtSourceEnergie(?CtSourceEnergie $ctSourceEnergie): self
    {
        $this->ctSourceEnergie = $ctSourceEnergie;

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

    public function getCtConstAvDedType(): ?CtConstAvDedType
    {
        return $this->ctConstAvDedType;
    }

    public function setCtConstAvDedType(?CtConstAvDedType $ctConstAvDedType): self
    {
        $this->ctConstAvDedType = $ctConstAvDedType;

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

    public function getCtCarosserie(): ?CtCarosserie
    {
        return $this->ctCarosserie;
    }

    public function setCtCarosserie(?CtCarosserie $ctCarosserie): self
    {
        $this->ctCarosserie = $ctCarosserie;

        return $this;
    }

    /**
     * @return Collection|CtConstAvDed[]
     */
    public function getConstAvDed(): Collection
    {
        return $this->constAvDed;
    }

    public function addConstAvDed(CtConstAvDed $constAvDed): self
    {
        if (!$this->constAvDed->contains($constAvDed)) {
            $this->constAvDed[] = $constAvDed;
            $constAvDed->addConstAvDedCarac($this);
        }

        return $this;
    }

    public function removeConstAvDed(CtConstAvDed $constAvDed): self
    {
        if ($this->constAvDed->contains($constAvDed)) {
            $this->constAvDed->removeElement($constAvDed);
            $constAvDed->removeConstAvDedCarac($this);
        }

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCadNumSerieType();
    }

}
