<?php

namespace App\Entity;



use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\CtUser;
use App\Entity\CtUsage;
use App\Entity\CtCentre;
use App\Entity\CtCarteGrise;
use App\Entity\CtTypeVisite;
use App\Entity\CtUtilisation;

/**
 * CtVisite
 *
 * @ORM\Table(name="ct_visite", indexes={@ORM\Index(name="IDX_7F3E82E355B81AF1", columns={"ct_utilisation_id"}), @ORM\Index(name="fk_ct_visite_ct_type_visite1_idx", columns={"ct_type_visite_id"}), @ORM\Index(name="fk_ct_visite_ct_carte_grise1_idx", columns={"ct_carte_grise_id"}), @ORM\Index(name="fk_ct_visite_ct_user2_idx", columns={"ct_verificateur_id"}), @ORM\Index(name="fk_ct_visite_ct_usage1_idx", columns={"ct_usage_id"}), @ORM\Index(name="fk_ct_visite_ct_centre1_idx", columns={"ct_centre_id"}), @ORM\Index(name="fk_ct_visite_ct_user1_idx", columns={"ct_user_id"})})
 * @ORM\Entity
 */
class CtVisite
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
     * @var bool|null
     *
     * @ORM\Column(name="vst_is_apte", type="boolean", nullable=true)
     */
    private $vstIsApte;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="vst_is_contre_visite", type="boolean", nullable=true)
     */
    private $vstIsContreVisite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vst_duree_reparation", type="string", length=100, nullable=true)
     */
    private $vstDureeReparation;

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
     * @var \CtCentre
     *
     * @ORM\ManyToOne(targetEntity="CtCentre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_centre_id", referencedColumnName="id")
     * })
     */
    private $ctCentre;

    /**
     * @var \CtTypeVisite
     *
     * @ORM\ManyToOne(targetEntity="CtTypeVisite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_type_visite_id", referencedColumnName="id")
     * })
     */
    private $ctTypeVisite;

    /**
     * @var \CtCarteGrise
     *
     * @ORM\ManyToOne(targetEntity="CtCarteGrise")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_carte_grise_id", referencedColumnName="id")
     * })
     */
    private $ctCarteGrise;

    /**
     * @var \CtUsage
     *
     * @ORM\ManyToOne(targetEntity="CtUsage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_usage_id", referencedColumnName="id")
     * })
     */
    private $ctUsage;

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
     * @var \CtUser
     *
     * @ORM\ManyToOne(targetEntity="CtUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_user_id", referencedColumnName="id")
     * })
     */
    private $ctUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CtVisiteExtra", mappedBy="ctVisite")
     */
    private $ctVisiteExtra;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CtAnomalie", mappedBy="ctVisite")
     */
    private $ctVisiteAnomalies;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ctVisiteExtra = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ctVisiteAnomalies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getVstIsApte(): ?bool
    {
        return $this->vstIsApte;
    }

    public function setVstIsApte(?bool $vstIsApte): self
    {
        $this->vstIsApte = $vstIsApte;

        return $this;
    }

    public function getVstIsContreVisite(): ?bool
    {
        return $this->vstIsContreVisite;
    }

    public function setVstIsContreVisite(?bool $vstIsContreVisite): self
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

    public function getCtUtilisation(): ?CtUtilisation
    {
        return $this->ctUtilisation;
    }

    public function setCtUtilisation(?CtUtilisation $ctUtilisation): self
    {
        $this->ctUtilisation = $ctUtilisation;

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

    public function getCtTypeVisite(): ?CtTypeVisite
    {
        return $this->ctTypeVisite;
    }

    public function setCtTypeVisite(?CtTypeVisite $ctTypeVisite): self
    {
        $this->ctTypeVisite = $ctTypeVisite;

        return $this;
    }

    public function getCtCarteGrise(): ?CtCarteGrise
    {
        return $this->ctCarteGrise;
    }

    public function setCtCarteGrise(?CtCarteGrise $ctCarteGrise): self
    {
        $this->ctCarteGrise = $ctCarteGrise;

        return $this;
    }

    public function getCtUsage(): ?CtUsage
    {
        return $this->ctUsage;
    }

    public function setCtUsage(?CtUsage $ctUsage): self
    {
        $this->ctUsage = $ctUsage;

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

    public function getCtUser(): ?CtUser
    {
        return $this->ctUser;
    }

    public function setCtUser(?CtUser $ctUser): self
    {
        $this->ctUser = $ctUser;

        return $this;
    }

    /**
     * @return Collection|CtVisiteExtra[]
     */
    public function getCtVisiteExtra(): Collection
    {
        return $this->ctVisiteExtra;
    }

    public function addCtVisiteExtra(CtVisiteExtra $ctVisiteExtra): self
    {
        if (!$this->ctVisiteExtra->contains($ctVisiteExtra)) {
            $this->ctVisiteExtra[] = $ctVisiteExtra;
            $ctVisiteExtra->addCtVisite($this);
        }

        return $this;
    }

    public function removeCtVisiteExtra(CtVisiteExtra $ctVisiteExtra): self
    {
        if ($this->ctVisiteExtra->contains($ctVisiteExtra)) {
            $this->ctVisiteExtra->removeElement($ctVisiteExtra);
            $ctVisiteExtra->removeCtVisite($this);
        }

        return $this;
    }

    /**
     * @return Collection|CtVisiteAnomalies[]
     */
    public function getCtVisiteAnomalie(): Collection
    {
        return $this->ctVisiteAnomalies;
    }

    public function addCtVisiteAnomalie(CtVisiteAnomalie $ctVisiteAnomalies): self
    {
        if (!$this->ctVisiteAnomalies->contains($ctVisiteAnomalies)) {
            $this->ctVisiteAnomalies[] = $ctVisiteAnomalies;
            $ctVisiteAnomalies->addCtVisite($this);
        }

        return $this;
    }

    public function removeCtVisiteAnomalie(CtVisiteAnomalie $ctVisiteAnomalies): self
    {
        if ($this->ctVisiteAnomalies->contains($ctVisiteAnomalies)) {
            $this->ctVisiteAnomalies->removeElement($ctVisiteAnomalies);
            $ctVisiteAnomalies->removeCtVisite($this);
        }

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
