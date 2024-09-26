<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtCentre
 *
 * @ORM\Table(name="ct_centre", indexes={@ORM\Index(name="fk_ct_centre_ct_province1_idx", columns={"ct_province_id"})})
 * @ORM\Entity
 */
class CtCentre
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
     * @ORM\Column(name="ctr_nom", type="string", length=255, nullable=true)
     */
    private $ctrNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ctr_code", type="string", length=255, nullable=true)
     */
    private $ctrCode;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ctr_created_at", type="datetime", nullable=true)
     */
    private $ctrCreatedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ctr_updated_at", type="datetime", nullable=true)
     */
    private $ctrUpdatedAt;

    /**
     * @var \CtProvince
     *
     * @ORM\ManyToOne(targetEntity="CtProvince")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_province_id", referencedColumnName="id")
     * })
     */
    private $ctProvince;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtrNom(): ?string
    {
        return $this->ctrNom;
    }

    public function setCtrNom(?string $ctrNom): self
    {
        $this->ctrNom = $ctrNom;

        return $this;
    }

    public function getCtrCode(): ?string
    {
        return $this->ctrCode;
    }

    public function setCtrCode(?string $ctrCode): self
    {
        $this->ctrCode = $ctrCode;

        return $this;
    }

    public function getCtrCreatedAt(): ?\DateTimeInterface
    {
        return $this->ctrCreatedAt;
    }

    public function setCtrCreatedAt(?\DateTimeInterface $ctrCreatedAt): self
    {
        $this->ctrCreatedAt = $ctrCreatedAt;

        return $this;
    }

    public function getCtrUpdatedAt(): ?\DateTimeInterface
    {
        return $this->ctrUpdatedAt;
    }

    public function setCtrUpdatedAt(?\DateTimeInterface $ctrUpdatedAt): self
    {
        $this->ctrUpdatedAt = $ctrUpdatedAt;

        return $this;
    }

    public function getCtProvince(): ?CtProvince
    {
        return $this->ctProvince;
    }

    public function setCtProvince(?CtProvince $ctProvince): self
    {
        $this->ctProvince = $ctProvince;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCtrNom();
    }


}
