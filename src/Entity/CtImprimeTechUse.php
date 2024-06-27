<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtImprimeTechUse
 *
 * @ORM\Table(name="ct_imprime_tech_use", indexes={@ORM\Index(name="fk_ct_itu_ct_controle_idx", columns={"ct_controle_id"}), @ORM\Index(name="fk_ct_itu_ct_bordereau_idx", columns={"ct_bordereau_id"}), @ORM\Index(name="fk_ct_itu_ct_user_idx", columns={"ct_user_id"}), @ORM\Index(name="fk_ct_itu_ct_centre_idx", columns={"ct_centre_id"}), @ORM\Index(name="fk_ct_itu_ct_imprime_tech_idx", columns={"ct_imprime_tech_id"})})
 * @ORM\Entity
 */
class CtImprimeTechUse
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
     * @ORM\Column(name="ct_controle_id", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $ctControleId = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="itu_numero", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $ituNumero = 'NULL';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="itu_used", type="boolean", nullable=true, options={"default"="NULL"})
     */
    private $ituUsed = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="itu_motif_used", type="string", length=64, nullable=true, options={"default"="NULL"})
     */
    private $ituMotifUsed = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="actived_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $activedAt = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $updatedAt = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="itu_observation", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $ituObservation = 'NULL';

    /**
     * @var \CtImprimeTech
     *
     * @ORM\ManyToOne(targetEntity="CtImprimeTech")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_imprime_tech_id", referencedColumnName="id")
     * })
     */
    private $ctImprimeTech;

    /**
     * @var \CtBordereau
     *
     * @ORM\ManyToOne(targetEntity="CtBordereau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_bordereau_id", referencedColumnName="id")
     * })
     */
    private $ctBordereau;

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

    public function getItuNumero(): ?int
    {
        return $this->ituNumero;
    }

    public function setItuNumero(?int $ituNumero): self
    {
        $this->ituNumero = $ituNumero;

        return $this;
    }

    public function getItuUsed(): ?bool
    {
        return $this->ituUsed;
    }

    public function setItuUsed(?bool $ituUsed): self
    {
        $this->ituUsed = $ituUsed;

        return $this;
    }

    public function getItuMotifUsed(): ?string
    {
        return $this->ituMotifUsed;
    }

    public function setItuMotifUsed(?string $ituMotifUsed): self
    {
        $this->ituMotifUsed = $ituMotifUsed;

        return $this;
    }

    public function getActivedAt(): ?\DateTimeInterface
    {
        return $this->activedAt;
    }

    public function setActivedAt(?\DateTimeInterface $activedAt): self
    {
        $this->activedAt = $activedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getItuObservation(): ?string
    {
        return $this->ituObservation;
    }

    public function setItuObservation(?string $ituObservation): self
    {
        $this->ituObservation = $ituObservation;

        return $this;
    }

    public function getCtImprimeTech(): ?CtImprimeTech
    {
        return $this->ctImprimeTech;
    }

    public function setCtImprimeTech(?CtImprimeTech $ctImprimeTech): self
    {
        $this->ctImprimeTech = $ctImprimeTech;

        return $this;
    }

    public function getCtBordereau(): ?CtBordereau
    {
        return $this->ctBordereau;
    }

    public function setCtBordereau(?CtBordereau $ctBordereau): self
    {
        $this->ctBordereau = $ctBordereau;

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

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCtControleId();
    }


}
