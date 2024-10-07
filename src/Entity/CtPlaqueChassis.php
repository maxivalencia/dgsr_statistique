<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtPlaqueChassis
 *
 * @ORM\Table(name="ct_plaque_chassis", indexes={@ORM\Index(name="IDX_E89C9F4E76255A68", columns={"ct_arrete_prix_id"})})
 * @ORM\Entity
 */
class CtPlaqueChassis
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
     * @ORM\Column(name="plq_type", type="string", length=255, nullable=true)
     */
    private $plqType;

    /**
     * @var float|null
     *
     * @ORM\Column(name="plq_tarif", type="float", precision=10, scale=0, nullable=true)
     */
    private $plqTarif;

    /**
     * @var \CtArretePrix
     *
     * @ORM\ManyToOne(targetEntity="CtArretePrix")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_arrete_prix_id", referencedColumnName="id")
     * })
     */
    private $ctArretePrix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlqType(): ?string
    {
        return $this->plqType;
    }

    public function setPlqType(?string $plqType): self
    {
        $this->plqType = $plqType;

        return $this;
    }

    public function getPlqTarif(): ?float
    {
        return $this->plqTarif;
    }

    public function setPlqTarif(?float $plqTarif): self
    {
        $this->plqTarif = $plqTarif;

        return $this;
    }

    public function getCtArretePrix(): ?CtArretePrix
    {
        return $this->ctArretePrix;
    }

    public function setCtArretePrix(?CtArretePrix $ctArretePrix): self
    {
        $this->ctArretePrix = $ctArretePrix;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getPlqType();
    }


}
