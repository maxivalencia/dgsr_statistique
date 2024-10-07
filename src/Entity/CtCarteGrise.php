<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtCarteGrise
 *
 * @ORM\Table(name="ct_carte_grise", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_A447BE7316321FAD", columns={"cg_immatriculation"})}, indexes={@ORM\Index(name="fk_ct_carte_grise_ct_vehicule1_idx", columns={"ct_vehicule_id"}), @ORM\Index(name="fk_ct_carte_grise_ct_centre1_idx", columns={"ct_centre_id"}), @ORM\Index(name="fk_ct_carte_grise_ct_carosserie1_idx", columns={"ct_carosserie_id"}), @ORM\Index(name="FK_A447BE73C50880EA", columns={"ct_zone_deserte_id"}), @ORM\Index(name="fk_ct_carte_grise_ct_source_energie1_idx", columns={"ct_source_energie_id"})})
 * @ORM\Entity
 */
class CtCarteGrise
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="cg_date_emission", type="date", nullable=true)
     */
    private $cgDateEmission;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_nom", type="string", length=255, nullable=true)
     */
    private $cgNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_prenom", type="string", length=255, nullable=true)
     */
    private $cgPrenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_profession", type="string", length=255, nullable=true)
     */
    private $cgProfession;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_adresse", type="string", length=255, nullable=true)
     */
    private $cgAdresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_phone", type="string", length=255, nullable=true)
     */
    private $cgPhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_commune", type="string", length=255, nullable=true)
     */
    private $cgCommune;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cg_nbr_assis", type="integer", nullable=true)
     */
    private $cgNbrAssis;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cg_nbr_debout", type="integer", nullable=true)
     */
    private $cgNbrDebout;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cg_puissance_admin", type="integer", nullable=true)
     */
    private $cgPuissanceAdmin;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cg_mise_en_service", type="date", nullable=true)
     */
    private $cgMiseEnService;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_patente", type="string", length=255, nullable=true)
     */
    private $cgPatente;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_ani", type="string", length=255, nullable=true)
     */
    private $cgAni;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_rta", type="string", length=255, nullable=true)
     */
    private $cgRta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_num_carte_violette", type="string", length=255, nullable=true)
     */
    private $cgNumCarteViolette;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cg_date_carte_violette", type="date", nullable=true)
     */
    private $cgDateCarteViolette;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_lieu_carte_violette", type="string", length=255, nullable=true)
     */
    private $cgLieuCarteViolette;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_num_vignette", type="string", length=255, nullable=true)
     */
    private $cgNumVignette;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cg_date_vignette", type="date", nullable=true)
     */
    private $cgDateVignette;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_lieu_vignette", type="string", length=255, nullable=true)
     */
    private $cgLieuVignette;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_immatriculation", type="string", length=45, nullable=true)
     */
    private $cgImmatriculation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cg_created", type="datetime", nullable=true)
     */
    private $cgCreated;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_nom_cooperative", type="string", length=100, nullable=true)
     */
    private $cgNomCooperative;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_itineraire", type="string", length=100, nullable=true)
     */
    private $cgItineraire;

    /**
     * @var bool
     *
     * @ORM\Column(name="cg_is_transport", type="boolean", nullable=false)
     */
    private $cgIsTransport;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_num_identification", type="string", length=45, nullable=true)
     */
    private $cgNumIdentification;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cg_zone_deserte", type="string", length=255, nullable=true)
     */
    private $cgZoneDeserte;

    /**
     * @var \CtVehicule
     *
     * @ORM\ManyToOne(targetEntity="CtVehicule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_vehicule_id", referencedColumnName="id")
     * })
     */
    private $ctVehicule;

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
     * @var \CtCentre
     *
     * @ORM\ManyToOne(targetEntity="CtCentre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_centre_id", referencedColumnName="id")
     * })
     */
    private $ctCentre;

    /**
     * @var \CtZoneDeserte
     *
     * @ORM\ManyToOne(targetEntity="CtZoneDeserte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_zone_deserte_id", referencedColumnName="id")
     * })
     */
    private $ctZoneDeserte;

    /**
     * @var \CtCarosserie
     *
     * @ORM\ManyToOne(targetEntity="CtCarosserie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_carosserie_id", referencedColumnName="id")
     * })
     */
    private $ctCarosserie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCgDateEmission(): ?\DateTimeInterface
    {
        return $this->cgDateEmission;
    }

    public function setCgDateEmission(?\DateTimeInterface $cgDateEmission): self
    {
        $this->cgDateEmission = $cgDateEmission;

        return $this;
    }

    public function getCgNom(): ?string
    {
        return $this->cgNom;
    }

    public function setCgNom(?string $cgNom): self
    {
        $this->cgNom = $cgNom;

        return $this;
    }

    public function getCgPrenom(): ?string
    {
        return $this->cgPrenom;
    }

    public function setCgPrenom(?string $cgPrenom): self
    {
        $this->cgPrenom = $cgPrenom;

        return $this;
    }

    public function getCgProfession(): ?string
    {
        return $this->cgProfession;
    }

    public function setCgProfession(?string $cgProfession): self
    {
        $this->cgProfession = $cgProfession;

        return $this;
    }

    public function getCgAdresse(): ?string
    {
        return $this->cgAdresse;
    }

    public function setCgAdresse(?string $cgAdresse): self
    {
        $this->cgAdresse = $cgAdresse;

        return $this;
    }

    public function getCgPhone(): ?string
    {
        return $this->cgPhone;
    }

    public function setCgPhone(?string $cgPhone): self
    {
        $this->cgPhone = $cgPhone;

        return $this;
    }

    public function getCgCommune(): ?string
    {
        return $this->cgCommune;
    }

    public function setCgCommune(?string $cgCommune): self
    {
        $this->cgCommune = $cgCommune;

        return $this;
    }

    public function getCgNbrAssis(): ?int
    {
        return $this->cgNbrAssis;
    }

    public function setCgNbrAssis(?int $cgNbrAssis): self
    {
        $this->cgNbrAssis = $cgNbrAssis;

        return $this;
    }

    public function getCgNbrDebout(): ?int
    {
        return $this->cgNbrDebout;
    }

    public function setCgNbrDebout(?int $cgNbrDebout): self
    {
        $this->cgNbrDebout = $cgNbrDebout;

        return $this;
    }

    public function getCgPuissanceAdmin(): ?int
    {
        return $this->cgPuissanceAdmin;
    }

    public function setCgPuissanceAdmin(?int $cgPuissanceAdmin): self
    {
        $this->cgPuissanceAdmin = $cgPuissanceAdmin;

        return $this;
    }

    public function getCgMiseEnService(): ?\DateTimeInterface
    {
        return $this->cgMiseEnService;
    }

    public function setCgMiseEnService(?\DateTimeInterface $cgMiseEnService): self
    {
        $this->cgMiseEnService = $cgMiseEnService;

        return $this;
    }

    public function getCgPatente(): ?string
    {
        return $this->cgPatente;
    }

    public function setCgPatente(?string $cgPatente): self
    {
        $this->cgPatente = $cgPatente;

        return $this;
    }

    public function getCgAni(): ?string
    {
        return $this->cgAni;
    }

    public function setCgAni(?string $cgAni): self
    {
        $this->cgAni = $cgAni;

        return $this;
    }

    public function getCgRta(): ?string
    {
        return $this->cgRta;
    }

    public function setCgRta(?string $cgRta): self
    {
        $this->cgRta = $cgRta;

        return $this;
    }

    public function getCgNumCarteViolette(): ?string
    {
        return $this->cgNumCarteViolette;
    }

    public function setCgNumCarteViolette(?string $cgNumCarteViolette): self
    {
        $this->cgNumCarteViolette = $cgNumCarteViolette;

        return $this;
    }

    public function getCgDateCarteViolette(): ?\DateTimeInterface
    {
        return $this->cgDateCarteViolette;
    }

    public function setCgDateCarteViolette(?\DateTimeInterface $cgDateCarteViolette): self
    {
        $this->cgDateCarteViolette = $cgDateCarteViolette;

        return $this;
    }

    public function getCgLieuCarteViolette(): ?string
    {
        return $this->cgLieuCarteViolette;
    }

    public function setCgLieuCarteViolette(?string $cgLieuCarteViolette): self
    {
        $this->cgLieuCarteViolette = $cgLieuCarteViolette;

        return $this;
    }

    public function getCgNumVignette(): ?string
    {
        return $this->cgNumVignette;
    }

    public function setCgNumVignette(?string $cgNumVignette): self
    {
        $this->cgNumVignette = $cgNumVignette;

        return $this;
    }

    public function getCgDateVignette(): ?\DateTimeInterface
    {
        return $this->cgDateVignette;
    }

    public function setCgDateVignette(?\DateTimeInterface $cgDateVignette): self
    {
        $this->cgDateVignette = $cgDateVignette;

        return $this;
    }

    public function getCgLieuVignette(): ?string
    {
        return $this->cgLieuVignette;
    }

    public function setCgLieuVignette(?string $cgLieuVignette): self
    {
        $this->cgLieuVignette = $cgLieuVignette;

        return $this;
    }

    public function getCgImmatriculation(): ?string
    {
        return $this->cgImmatriculation;
    }

    public function setCgImmatriculation(?string $cgImmatriculation): self
    {
        $this->cgImmatriculation = $cgImmatriculation;

        return $this;
    }

    public function getCgCreated(): ?\DateTimeInterface
    {
        return $this->cgCreated;
    }

    public function setCgCreated(?\DateTimeInterface $cgCreated): self
    {
        $this->cgCreated = $cgCreated;

        return $this;
    }

    public function getCgNomCooperative(): ?string
    {
        return $this->cgNomCooperative;
    }

    public function setCgNomCooperative(?string $cgNomCooperative): self
    {
        $this->cgNomCooperative = $cgNomCooperative;

        return $this;
    }

    public function getCgItineraire(): ?string
    {
        return $this->cgItineraire;
    }

    public function setCgItineraire(?string $cgItineraire): self
    {
        $this->cgItineraire = $cgItineraire;

        return $this;
    }

    public function getCgIsTransport(): ?bool
    {
        return $this->cgIsTransport;
    }

    public function setCgIsTransport(bool $cgIsTransport): self
    {
        $this->cgIsTransport = $cgIsTransport;

        return $this;
    }

    public function getCgNumIdentification(): ?string
    {
        return $this->cgNumIdentification;
    }

    public function setCgNumIdentification(?string $cgNumIdentification): self
    {
        $this->cgNumIdentification = $cgNumIdentification;

        return $this;
    }

    public function getCgZoneDeserte(): ?string
    {
        return $this->cgZoneDeserte;
    }

    public function setCgZoneDeserte(?string $cgZoneDeserte): self
    {
        $this->cgZoneDeserte = $cgZoneDeserte;

        return $this;
    }

    public function getCtVehicule(): ?CtVehicule
    {
        return $this->ctVehicule;
    }

    public function setCtVehicule(?CtVehicule $ctVehicule): self
    {
        $this->ctVehicule = $ctVehicule;

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

    public function getCtCentre(): ?CtCentre
    {
        return $this->ctCentre;
    }

    public function setCtCentre(?CtCentre $ctCentre): self
    {
        $this->ctCentre = $ctCentre;

        return $this;
    }

    public function getCtZoneDeserte(): ?CtZoneDeserte
    {
        return $this->ctZoneDeserte;
    }

    public function setCtZoneDeserte(?CtZoneDeserte $ctZoneDeserte): self
    {
        $this->ctZoneDeserte = $ctZoneDeserte;

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
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCgImmatriculation();
    }


}
