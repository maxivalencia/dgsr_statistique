<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtReception
 *
 * @ORM\Table(name="ct_reception", indexes={@ORM\Index(name="IDX_942215A27EE62163", columns={"ct_source_energie_id"}), @ORM\Index(name="fk_ct_reception_ct_user1_idx", columns={"ct_user_id"}), @ORM\Index(name="fk_ct_reception_ct_type_reception1_idx", columns={"ct_type_reception_id"}), @ORM\Index(name="IDX_942215A2F2AE3878", columns={"ct_carosserie_id"}), @ORM\Index(name="fk_ct_reception_ct_vehicule1_idx", columns={"ct_vehicule_id"}), @ORM\Index(name="fk_ct_reception_ct_motif1_idx", columns={"ct_motif_id"}), @ORM\Index(name="IDX_942215A2D74CE6E6", columns={"ct_genre_id"}), @ORM\Index(name="fk_ct_reception_ct_centre1_idx", columns={"ct_centre_id"}), @ORM\Index(name="fk_ct_reception_ct_utilisation1_idx", columns={"ct_utilisation_id"})})
 * @ORM\Entity
 */
class CtReception
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
     * @ORM\Column(name="rcp_mise_service", type="date", nullable=true)
     */
    private $rcpMiseService;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rcp_immatriculation", type="string", length=45, nullable=true)
     */
    private $rcpImmatriculation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rcp_proprietaire", type="string", length=255, nullable=true)
     */
    private $rcpProprietaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rcp_profession", type="string", length=100, nullable=true)
     */
    private $rcpProfession;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rcp_adresse", type="string", length=255, nullable=true)
     */
    private $rcpAdresse;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rcp_nbr_assis", type="integer", nullable=true)
     */
    private $rcpNbrAssis;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rcp_nbr_debout", type="integer", nullable=true)
     */
    private $rcpNbrDebout;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rcp_num_pv", type="string", length=100, nullable=true)
     */
    private $rcpNumPv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rcp_num_group", type="string", length=255, nullable=true)
     */
    private $rcpNumGroup;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="rcp_created", type="date", nullable=true)
     */
    private $rcpCreated;

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
     * @var \CtMotif
     *
     * @ORM\ManyToOne(targetEntity="CtMotif")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_motif_id", referencedColumnName="id")
     * })
     */
    private $ctMotif;

    /**
     * @var \CtTypeReception
     *
     * @ORM\ManyToOne(targetEntity="CtTypeReception")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_type_reception_id", referencedColumnName="id")
     * })
     */
    private $ctTypeReception;

    /**
     * @var \CtUtilisation
     *
     * @ORM\ManyToOne(targetEntity="CtUtilisation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_utilisation_id", referencedColumnName="id")
     * })
     */
    private $ctUtilisation;

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
     * @var \CtUser
     *
     * @ORM\ManyToOne(targetEntity="CtUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_user_id", referencedColumnName="id")
     * })
     */
    private $ctUser;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRcpMiseService(): ?\DateTimeInterface
    {
        return $this->rcpMiseService;
    }

    public function setRcpMiseService(?\DateTimeInterface $rcpMiseService): self
    {
        $this->rcpMiseService = $rcpMiseService;

        return $this;
    }

    public function getRcpImmatriculation(): ?string
    {
        return $this->rcpImmatriculation;
    }

    public function setRcpImmatriculation(?string $rcpImmatriculation): self
    {
        $this->rcpImmatriculation = $rcpImmatriculation;

        return $this;
    }

    public function getRcpProprietaire(): ?string
    {
        return $this->rcpProprietaire;
    }

    public function setRcpProprietaire(?string $rcpProprietaire): self
    {
        $this->rcpProprietaire = $rcpProprietaire;

        return $this;
    }

    public function getRcpProfession(): ?string
    {
        return $this->rcpProfession;
    }

    public function setRcpProfession(?string $rcpProfession): self
    {
        $this->rcpProfession = $rcpProfession;

        return $this;
    }

    public function getRcpAdresse(): ?string
    {
        return $this->rcpAdresse;
    }

    public function setRcpAdresse(?string $rcpAdresse): self
    {
        $this->rcpAdresse = $rcpAdresse;

        return $this;
    }

    public function getRcpNbrAssis(): ?int
    {
        return $this->rcpNbrAssis;
    }

    public function setRcpNbrAssis(?int $rcpNbrAssis): self
    {
        $this->rcpNbrAssis = $rcpNbrAssis;

        return $this;
    }

    public function getRcpNbrDebout(): ?int
    {
        return $this->rcpNbrDebout;
    }

    public function setRcpNbrDebout(?int $rcpNbrDebout): self
    {
        $this->rcpNbrDebout = $rcpNbrDebout;

        return $this;
    }

    public function getRcpNumPv(): ?string
    {
        return $this->rcpNumPv;
    }

    public function setRcpNumPv(?string $rcpNumPv): self
    {
        $this->rcpNumPv = $rcpNumPv;

        return $this;
    }

    public function getRcpNumGroup(): ?string
    {
        return $this->rcpNumGroup;
    }

    public function setRcpNumGroup(?string $rcpNumGroup): self
    {
        $this->rcpNumGroup = $rcpNumGroup;

        return $this;
    }

    public function getRcpCreated(): ?\DateTimeInterface
    {
        return $this->rcpCreated;
    }

    public function setRcpCreated(?\DateTimeInterface $rcpCreated): self
    {
        $this->rcpCreated = $rcpCreated;

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

    public function getCtMotif(): ?CtMotif
    {
        return $this->ctMotif;
    }

    public function setCtMotif(?CtMotif $ctMotif): self
    {
        $this->ctMotif = $ctMotif;

        return $this;
    }

    public function getCtTypeReception(): ?CtTypeReception
    {
        return $this->ctTypeReception;
    }

    public function setCtTypeReception(?CtTypeReception $ctTypeReception): self
    {
        $this->ctTypeReception = $ctTypeReception;

        return $this;
    }

    public function getCtUtilisation(): ?CtUtilisation
    {
        return $this->ctUtilisation;
    }

    public function setCtUtilisation(?CtUtilisation $ctUtilisation): self
    {
        $this->ctUtilisation = $ctUtilisation;

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

    public function getCtUser(): ?CtUser
    {
        return $this->ctUser;
    }

    public function setCtUser(?CtUser $ctUser): self
    {
        $this->ctUser = $ctUser;

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
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getRcpNumPv();
    }


}
