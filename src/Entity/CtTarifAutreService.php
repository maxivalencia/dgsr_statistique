<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtTarifAutreService
 *
 * @ORM\Table(name="ct_tarif_autre_service", indexes={@ORM\Index(name="IDX_A90BA8FCDFC9C14E", columns={"ct_type_autre_sce_id"}), @ORM\Index(name="IDX_A90BA8FC76255A68", columns={"ct_arrete_prix_id"})})
 * @ORM\Entity
 */
class CtTarifAutreService
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
     * @var float
     *
     * @ORM\Column(name="tas_tarif", type="float", precision=10, scale=0, nullable=false)
     */
    private $tasTarif;

    /**
     * @var \CtArretePrix
     *
     * @ORM\ManyToOne(targetEntity="CtArretePrix")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_arrete_prix_id", referencedColumnName="id")
     * })
     */
    private $ctArretePrix;

    /**
     * @var \CtTypeAutreSce
     *
     * @ORM\ManyToOne(targetEntity="CtTypeAutreSce")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_type_autre_sce_id", referencedColumnName="id")
     * })
     */
    private $ctTypeAutreSce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTasTarif(): ?float
    {
        return $this->tasTarif;
    }

    public function setTasTarif(float $tasTarif): self
    {
        $this->tasTarif = $tasTarif;

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
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCtTypeAutreSce();
    }


}
