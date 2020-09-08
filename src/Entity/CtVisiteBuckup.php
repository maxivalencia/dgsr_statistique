<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtVisiteBuckup
 *
 * @ORM\Table(name="ct_visite_buckup", indexes={@ORM\Index(name="fk_ct_visite_ct_centre1_idx", columns={"ct_centre_id"}), @ORM\Index(name="fk_ct_visite_ct_usage1_idx", columns={"ct_usage_id"}), @ORM\Index(name="fk_ct_visite_ct_type_visite1_idx", columns={"ct_type_visite_id"}), @ORM\Index(name="fk_ct_visite_ct_user2_idx", columns={"ct_verificateur_id"}), @ORM\Index(name="IDX_7F3E82E355B81AF1", columns={"ct_utilisation_id"}), @ORM\Index(name="fk_ct_visite_ct_carte_grise1_idx", columns={"ct_carte_grise_id"}), @ORM\Index(name="fk_ct_visite_ct_user1_idx", columns={"ct_user_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CtVisiteBuckupRepository")
 */
class CtVisiteBuckup
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
     * @ORM\Column(name="ct_carte_grise_id", type="integer", nullable=true)
     */
    private $ctCarteGriseId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_centre_id", type="integer", nullable=true)
     */
    private $ctCentreId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_type_visite_id", type="integer", nullable=true)
     */
    private $ctTypeVisiteId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_usage_id", type="integer", nullable=true)
     */
    private $ctUsageId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_user_id", type="integer", nullable=true)
     */
    private $ctUserId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_verificateur_id", type="integer", nullable=true)
     */
    private $ctVerificateurId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vst_num_pv", type="string", length=255, nullable=true)
     */
    private $vstNumPv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vst_num_feuille_caisse", type="string", length=255, nullable=true)
     */
    private $vstNumFeuilleCaisse;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="vst_date_expiration", type="date", nullable=true)
     */
    private $vstDateExpiration;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="vst_created", type="datetime", nullable=true)
     */
    private $vstCreated;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="vst_updated", type="datetime", nullable=true)
     */
    private $vstUpdated;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_utilisation_id", type="integer", nullable=true)
     */
    private $ctUtilisationId;

    /**
     * @var bool
     *
     * @ORM\Column(name="vst_is_apte", type="boolean", nullable=false)
     */
    private $vstIsApte;

    /**
     * @var bool
     *
     * @ORM\Column(name="vst_is_contre_visite", type="boolean", nullable=false)
     */
    private $vstIsContreVisite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vst_duree_reparation", type="string", length=100, nullable=true)
     */
    private $vstDureeReparation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtCarteGriseId(): ?int
    {
        return $this->ctCarteGriseId;
    }

    public function setCtCarteGriseId(?int $ctCarteGriseId): self
    {
        $this->ctCarteGriseId = $ctCarteGriseId;

        return $this;
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

    public function getCtTypeVisiteId(): ?int
    {
        return $this->ctTypeVisiteId;
    }

    public function setCtTypeVisiteId(?int $ctTypeVisiteId): self
    {
        $this->ctTypeVisiteId = $ctTypeVisiteId;

        return $this;
    }

    public function getCtUsageId(): ?int
    {
        return $this->ctUsageId;
    }

    public function setCtUsageId(?int $ctUsageId): self
    {
        $this->ctUsageId = $ctUsageId;

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

    public function getCtVerificateurId(): ?int
    {
        return $this->ctVerificateurId;
    }

    public function setCtVerificateurId(?int $ctVerificateurId): self
    {
        $this->ctVerificateurId = $ctVerificateurId;

        return $this;
    }

    public function getVstNumPv(): ?string
    {
        return $this->vstNumPv;
    }

    public function setVstNumPv(?string $vstNumPv): self
    {
        $this->vstNumPv = $vstNumPv;

        return $this;
    }

    public function getVstNumFeuilleCaisse(): ?string
    {
        return $this->vstNumFeuilleCaisse;
    }

    public function setVstNumFeuilleCaisse(?string $vstNumFeuilleCaisse): self
    {
        $this->vstNumFeuilleCaisse = $vstNumFeuilleCaisse;

        return $this;
    }

    public function getVstDateExpiration(): ?\DateTimeInterface
    {
        return $this->vstDateExpiration;
    }

    public function setVstDateExpiration(?\DateTimeInterface $vstDateExpiration): self
    {
        $this->vstDateExpiration = $vstDateExpiration;

        return $this;
    }

    public function getVstCreated(): ?\DateTimeInterface
    {
        return $this->vstCreated;
    }

    public function setVstCreated(?\DateTimeInterface $vstCreated): self
    {
        $this->vstCreated = $vstCreated;

        return $this;
    }

    public function getVstUpdated(): ?\DateTimeInterface
    {
        return $this->vstUpdated;
    }

    public function setVstUpdated(?\DateTimeInterface $vstUpdated): self
    {
        $this->vstUpdated = $vstUpdated;

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

    public function getVstIsApte(): ?bool
    {
        return $this->vstIsApte;
    }

    public function setVstIsApte(bool $vstIsApte): self
    {
        $this->vstIsApte = $vstIsApte;

        return $this;
    }

    public function getVstIsContreVisite(): ?bool
    {
        return $this->vstIsContreVisite;
    }

    public function setVstIsContreVisite(bool $vstIsContreVisite): self
    {
        $this->vstIsContreVisite = $vstIsContreVisite;

        return $this;
    }

    public function getVstDureeReparation(): ?string
    {
        return $this->vstDureeReparation;
    }

    public function setVstDureeReparation(?string $vstDureeReparation): self
    {
        $this->vstDureeReparation = $vstDureeReparation;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getVstNumPv();
    }


}
