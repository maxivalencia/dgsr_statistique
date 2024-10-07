<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtUsage
 *
 * @ORM\Table(name="ct_usage", indexes={@ORM\Index(name="IDX_C8709F46E2563560", columns={"ct_type_usage_id"})})
 * @ORM\Entity
 */
class CtUsage
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
     * @ORM\Column(name="usg_libelle", type="string", length=255, nullable=true)
     */
    private $usgLibelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usg_validite", type="string", length=255, nullable=true)
     */
    private $usgValidite;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="usg_created", type="datetime", nullable=true)
     */
    private $usgCreated;

    /**
     * @var \CtTypeUsage
     *
     * @ORM\ManyToOne(targetEntity="CtTypeUsage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_type_usage_id", referencedColumnName="id")
     * })
     */
    private $ctTypeUsage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsgLibelle(): ?string
    {
        return $this->usgLibelle;
    }

    public function setUsgLibelle(?string $usgLibelle): self
    {
        $this->usgLibelle = $usgLibelle;

        return $this;
    }

    public function getUsgValidite(): ?string
    {
        return $this->usgValidite;
    }

    public function setUsgValidite(?string $usgValidite): self
    {
        $this->usgValidite = $usgValidite;

        return $this;
    }

    public function getUsgCreated(): ?\DateTimeInterface
    {
        return $this->usgCreated;
    }

    public function setUsgCreated(?\DateTimeInterface $usgCreated): self
    {
        $this->usgCreated = $usgCreated;

        return $this;
    }

    public function getCtTypeUsage(): ?CtTypeUsage
    {
        return $this->ctTypeUsage;
    }

    public function setCtTypeUsage(?CtTypeUsage $ctTypeUsage): self
    {
        $this->ctTypeUsage = $ctTypeUsage;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getUsgLibelle();
    }


}
