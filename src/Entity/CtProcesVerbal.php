<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtProcesVerbal
 *
 * @ORM\Table(name="ct_proces_verbal", indexes={@ORM\Index(name="IDX_556CD10D76255A68", columns={"ct_arrete_prix_id"})})
 * @ORM\Entity
 */
class CtProcesVerbal
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
     * @ORM\Column(name="pv_type", type="string", length=255, nullable=true)
     */
    private $pvType;

    /**
     * @var float|null
     *
     * @ORM\Column(name="pv_tarif", type="float", precision=10, scale=0, nullable=true)
     */
    private $pvTarif;

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

    public function getPvType(): ?string
    {
        return $this->pvType;
    }

    public function setPvType(?string $pvType): self
    {
        $this->pvType = $pvType;

        return $this;
    }

    public function getPvTarif(): ?float
    {
        return $this->pvTarif;
    }

    public function setPvTarif(?float $pvTarif): self
    {
        $this->pvTarif = $pvTarif;

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
        return $this->getPvType();
    }


}
