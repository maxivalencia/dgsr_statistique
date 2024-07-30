<?php

namespace App\Entity;



use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtAutreSce
 *
 * @ORM\Table(name="ct_autre_sce", indexes={@ORM\Index(name="IDX_349B4AB1DAAA4D0D", columns={"ct_option_vitre_fumee_id"}), @ORM\Index(name="IDX_349B4AB182C8474E", columns={"ct_centre_id"}), @ORM\Index(name="IDX_349B4AB1DFC9C14E", columns={"ct_type_autre_sce_id"}), @ORM\Index(name="IDX_349B4AB1C211A85D", columns={"ct_user_id"}), @ORM\Index(name="IDX_349B4AB1A2084498", columns={"ct_carte_grise_id"}), @ORM\Index(name="IDX_349B4AB1BDF4F30F", columns={"ct_verificateur_id"}), @ORM\Index(name="IDX_349B4AB155B81AF1", columns={"ct_utilisation_id"})})
 * @ORM\Entity
 */
class CtAutreSce
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
     * @ORM\Column(name="ct_controle_id", type="integer", nullable=true)
     */
    private $ctControleId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="as_date", type="date", nullable=true)
     */
    private $asDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="as_created", type="datetime", nullable=true)
     */
    private $asCreated;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="as_updated", type="datetime", nullable=true)
     */
    private $asUpdated;

    /**
     * @var bool
     *
     * @ORM\Column(name="as_is_deleted", type="boolean", nullable=false)
     */
    private $asIsDeleted;

    /**
     * @var string|null
     *
     * @ORM\Column(name="as_motif_deleted", type="string", length=255, nullable=true)
     */
    private $asMotifDeleted;

    /**
     * @var string|null
     *
     * @ORM\Column(name="as_validite_fumee", type="string", length=255, nullable=true)
     */
    private $asValiditeFumee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="as_itineraire_speciale", type="string", length=255, nullable=true)
     */
    private $asItineraireSpeciale;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="as_validite_speciale", type="date", nullable=true)
     */
    private $asValiditeSpeciale;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="as_deleted", type="datetime", nullable=true)
     */
    private $asDeleted;

    /**
     * @var string|null
     *
     * @ORM\Column(name="as_num_pv", type="string", length=100, nullable=true)
     */
    private $asNumPv;

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
     * @var \CtCarteGrise
     *
     * @ORM\ManyToOne(targetEntity="CtCarteGrise")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_carte_grise_id", referencedColumnName="id")
     * })
     */
    private $ctCarteGrise;

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
     * @var \CtOptionVitreFumee
     *
     * @ORM\ManyToOne(targetEntity="CtOptionVitreFumee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_option_vitre_fumee_id", referencedColumnName="id")
     * })
     */
    private $ctOptionVitreFumee;

    /**
     * @var \CtTypeAutreSce
     *
     * @ORM\ManyToOne(targetEntity="CtTypeAutreSce")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_type_autre_sce_id", referencedColumnName="id")
     * })
     */
    private $ctTypeAutreSce;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CtImprimeTech", inversedBy="ctAutreSce")
     * @ORM\JoinTable(name="ct_autre_sce_imprime_tech",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ct_autre_sce_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ct_imprime_tech_id", referencedColumnName="id")
     *   }
     * )
     */
    private $ctImprimeTech;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ctImprimeTech = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtControleId(): ?int
    {
        return $this->ctControleId;
    }

    public function setCtControleId(?int $ctControleId): self
    {
        $this->ctControleId = $ctControleId;

        return $this;
    }

    public function getAsDate(): ?\DateTimeInterface
    {
        return $this->asDate;
    }

    public function setAsDate(?\DateTimeInterface $asDate): self
    {
        $this->asDate = $asDate;

        return $this;
    }

    public function getAsCreated(): ?\DateTimeInterface
    {
        return $this->asCreated;
    }

    public function setAsCreated(?\DateTimeInterface $asCreated): self
    {
        $this->asCreated = $asCreated;

        return $this;
    }

    public function getAsUpdated(): ?\DateTimeInterface
    {
        return $this->asUpdated;
    }

    public function setAsUpdated(?\DateTimeInterface $asUpdated): self
    {
        $this->asUpdated = $asUpdated;

        return $this;
    }

    public function getAsIsDeleted(): ?bool
    {
        return $this->asIsDeleted;
    }

    public function setAsIsDeleted(bool $asIsDeleted): self
    {
        $this->asIsDeleted = $asIsDeleted;

        return $this;
    }

    public function getAsMotifDeleted(): ?string
    {
        return $this->asMotifDeleted;
    }

    public function setAsMotifDeleted(?string $asMotifDeleted): self
    {
        $this->asMotifDeleted = $asMotifDeleted;

        return $this;
    }

    public function getAsValiditeFumee(): ?string
    {
        return $this->asValiditeFumee;
    }

    public function setAsValiditeFumee(?string $asValiditeFumee): self
    {
        $this->asValiditeFumee = $asValiditeFumee;

        return $this;
    }

    public function getAsItineraireSpeciale(): ?string
    {
        return $this->asItineraireSpeciale;
    }

    public function setAsItineraireSpeciale(?string $asItineraireSpeciale): self
    {
        $this->asItineraireSpeciale = $asItineraireSpeciale;

        return $this;
    }

    public function getAsValiditeSpeciale(): ?\DateTimeInterface
    {
        return $this->asValiditeSpeciale;
    }

    public function setAsValiditeSpeciale(?\DateTimeInterface $asValiditeSpeciale): self
    {
        $this->asValiditeSpeciale = $asValiditeSpeciale;

        return $this;
    }

    public function getAsDeleted(): ?\DateTimeInterface
    {
        return $this->asDeleted;
    }

    public function setAsDeleted(?\DateTimeInterface $asDeleted): self
    {
        $this->asDeleted = $asDeleted;

        return $this;
    }

    public function getAsNumPv(): ?string
    {
        return $this->asNumPv;
    }

    public function setAsNumPv(?string $asNumPv): self
    {
        $this->asNumPv = $asNumPv;

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

    public function getCtCarteGrise(): ?CtCarteGrise
    {
        return $this->ctCarteGrise;
    }

    public function setCtCarteGrise(?CtCarteGrise $ctCarteGrise): self
    {
        $this->ctCarteGrise = $ctCarteGrise;

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

    public function getCtOptionVitreFumee(): ?CtOptionVitreFumee
    {
        return $this->ctOptionVitreFumee;
    }

    public function setCtOptionVitreFumee(?CtOptionVitreFumee $ctOptionVitreFumee): self
    {
        $this->ctOptionVitreFumee = $ctOptionVitreFumee;

        return $this;
    }

    public function getCtTypeAutreSce(): ?CtTypeAutreSce
    {
        return $this->ctTypeAutreSce;
    }

    public function setCtTypeAutreSce(?CtTypeAutreSce $ctTypeAutreSce): self
    {
        $this->ctTypeAutreSce = $ctTypeAutreSce;

        return $this;
    }

    /**
     * @return Collection|CtImprimeTech[]
     */
    public function getCtImprimeTech(): Collection
    {
        return $this->ctImprimeTech;
    }

    public function addCtImprimeTech(CtImprimeTech $ctImprimeTech): self
    {
        if (!$this->ctImprimeTech->contains($ctImprimeTech)) {
            $this->ctImprimeTech[] = $ctImprimeTech;
        }

        return $this;
    }

    public function removeCtImprimeTech(CtImprimeTech $ctImprimeTech): self
    {
        if ($this->ctImprimeTech->contains($ctImprimeTech)) {
            $this->ctImprimeTech->removeElement($ctImprimeTech);
        }

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getAsNumPv();
    }

}
