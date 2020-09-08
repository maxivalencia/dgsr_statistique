<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtReceptionBackup
 *
 * @ORM\Table(name="ct_reception_backup", indexes={@ORM\Index(name="fk_ct_reception_ct_user1_idx", columns={"ct_user_id"}), @ORM\Index(name="fk_ct_reception_ct_centre1_idx", columns={"ct_centre_id"}), @ORM\Index(name="IDX_942215A2F2AE3878", columns={"ct_carosserie_id"}), @ORM\Index(name="fk_ct_reception_ct_motif1_idx", columns={"ct_motif_id"}), @ORM\Index(name="fk_ct_reception_ct_vehicule1_idx", columns={"ct_vehicule_id"}), @ORM\Index(name="IDX_942215A27EE62163", columns={"ct_source_energie_id"}), @ORM\Index(name="fk_ct_reception_ct_type_reception1_idx", columns={"ct_type_reception_id"}), @ORM\Index(name="fk_ct_reception_ct_utilisation1_idx", columns={"ct_utilisation_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CtReceptionBackupRepository")
 */
class CtReceptionBackup
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
     * @var int|null
     *
     * @ORM\Column(name="ct_centre_id", type="integer", nullable=true)
     */
    private $ctCentreId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_motif_id", type="integer", nullable=true)
     */
    private $ctMotifId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_type_reception_id", type="integer", nullable=true)
     */
    private $ctTypeReceptionId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_user_id", type="integer", nullable=true)
     */
    private $ctUserId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_utilisation_id", type="integer", nullable=true)
     */
    private $ctUtilisationId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_vehicule_id", type="integer", nullable=true)
     */
    private $ctVehiculeId;

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
     * @var int|null
     *
     * @ORM\Column(name="ct_source_energie_id", type="integer", nullable=true)
     */
    private $ctSourceEnergieId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_carosserie_id", type="integer", nullable=true)
     */
    private $ctCarosserieId;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtCentreId(): ?int
    {
        return $this->ctCentreId;
    }

    public function setCtCentreId(?int $ctCentreId): self
    {
        $this->ctCentreId = $ctCentreId;

        return $this;
    }

    public function getCtMotifId(): ?int
    {
        return $this->ctMotifId;
    }

    public function setCtMotifId(?int $ctMotifId): self
    {
        $this->ctMotifId = $ctMotifId;

        return $this;
    }

    public function getCtTypeReceptionId(): ?int
    {
        return $this->ctTypeReceptionId;
    }

    public function setCtTypeReceptionId(?int $ctTypeReceptionId): self
    {
        $this->ctTypeReceptionId = $ctTypeReceptionId;

        return $this;
    }

    public function getCtUserId(): ?int
    {
        return $this->ctUserId;
    }

    public function setCtUserId(?int $ctUserId): self
    {
        $this->ctUserId = $ctUserId;

        return $this;
    }

    public function getCtUtilisationId(): ?int
    {
        return $this->ctUtilisationId;
    }

    public function setCtUtilisationId(?int $ctUtilisationId): self
    {
        $this->ctUtilisationId = $ctUtilisationId;

        return $this;
    }

    public function getCtVehiculeId(): ?int
    {
        return $this->ctVehiculeId;
    }

    public function setCtVehiculeId(?int $ctVehiculeId): self
    {
        $this->ctVehiculeId = $ctVehiculeId;

        return $this;
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

    public function getCtSourceEnergieId(): ?int
    {
        return $this->ctSourceEnergieId;
    }

    public function setCtSourceEnergieId(?int $ctSourceEnergieId): self
    {
        $this->ctSourceEnergieId = $ctSourceEnergieId;

        return $this;
    }

    public function getCtCarosserieId(): ?int
    {
        return $this->ctCarosserieId;
    }

    public function setCtCarosserieId(?int $ctCarosserieId): self
    {
        $this->ctCarosserieId = $ctCarosserieId;

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

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getRcpImmatriculation();
    }


}
