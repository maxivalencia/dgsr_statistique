<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtBordereau
 *
 * @ORM\Table(name="ct_bordereau", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_334055EC6957720682C8474E2ADBF4F2", columns={"bl_debut_numero", "ct_centre_id", "ct_imprime_tech_id"})}, indexes={@ORM\Index(name="IDX_334055EC82C8474E", columns={"ct_centre_id"}), @ORM\Index(name="IDX_334055EC2ADBF4F2", columns={"ct_imprime_tech_id"}), @ORM\Index(name="IDX_334055ECC211A85D", columns={"ct_user_id"})})
 * @ORM\Entity
 */
class CtBordereau
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
     * @var string
     *
     * @ORM\Column(name="bl_numero", type="string", length=64, nullable=false)
     */
    private $blNumero;

    /**
     * @var int
     *
     * @ORM\Column(name="bl_debut_numero", type="integer", nullable=false)
     */
    private $blDebutNumero;

    /**
     * @var int
     *
     * @ORM\Column(name="bl_fin_numero", type="integer", nullable=false)
     */
    private $blFinNumero;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="bl_created_at", type="datetime", nullable=true)
     */
    private $blCreatedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="bl_updated_at", type="datetime", nullable=true)
     */
    private $blUpdatedAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ref_expr", type="string", length=64, nullable=true)
     */
    private $refExpr;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_ref_expr", type="datetime", nullable=true)
     */
    private $dateRefExpr;

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

    public function getBlNumero(): ?string
    {
        return $this->blNumero;
    }

    public function setBlNumero(string $blNumero): self
    {
        $this->blNumero = $blNumero;

        return $this;
    }

    public function getBlDebutNumero(): ?int
    {
        return $this->blDebutNumero;
    }

    public function setBlDebutNumero(int $blDebutNumero): self
    {
        $this->blDebutNumero = $blDebutNumero;

        return $this;
    }

    public function getBlFinNumero(): ?int
    {
        return $this->blFinNumero;
    }

    public function setBlFinNumero(int $blFinNumero): self
    {
        $this->blFinNumero = $blFinNumero;

        return $this;
    }

    public function getBlCreatedAt(): ?\DateTimeInterface
    {
        return $this->blCreatedAt;
    }

    public function setBlCreatedAt(?\DateTimeInterface $blCreatedAt): self
    {
        $this->blCreatedAt = $blCreatedAt;

        return $this;
    }

    public function getBlUpdatedAt(): ?\DateTimeInterface
    {
        return $this->blUpdatedAt;
    }

    public function setBlUpdatedAt(?\DateTimeInterface $blUpdatedAt): self
    {
        $this->blUpdatedAt = $blUpdatedAt;

        return $this;
    }

    public function getRefExpr(): ?string
    {
        return $this->refExpr;
    }

    public function setRefExpr(?string $refExpr): self
    {
        $this->refExpr = $refExpr;

        return $this;
    }

    public function getDateRefExpr(): ?\DateTimeInterface
    {
        return $this->dateRefExpr;
    }

    public function setDateRefExpr(?\DateTimeInterface $dateRefExpr): self
    {
        $this->dateRefExpr = $dateRefExpr;

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
        return $this->getBlNumero();
    }


}
