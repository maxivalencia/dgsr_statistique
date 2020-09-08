<?php

namespace App\Entity;

use App\Entity\CtAnomalieType;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CtAnomalie
 *
 * @ORM\Table(name="ct_anomalie", indexes={@ORM\Index(name="fk_ct_anomalie_ct_anomalie_type1_idx", columns={"ct_anomalie_type_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CtAnomalieRepository")
 */
class CtAnomalie
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
     * @ORM\Column(name="anml_libelle", type="string", length=100, nullable=true)
     */
    private $anmlLibelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="anml_code", type="string", length=10, nullable=true)
     */
    private $anmlCode;

    /**
     * @var \CtAnomalieType
     *
     * @ORM\ManyToOne(targetEntity="CtAnomalieType", inversedBy="ctAnomalies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_anomalie_type_id", referencedColumnName="id")
     * })
     */
    private $ctAnomalieType;

    
    public function __construct()
    {
        $this->CtAnomalieType =  new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnmlLibelle(): ?string
    {
        return $this->anmlLibelle;
    }

    public function setAnmlLibelle(?string $anmlLibelle): self
    {
        $this->anmlLibelle = $anmlLibelle;

        return $this;
    }

    public function getAnmlCode(): ?string
    {
        return $this->anmlCode;
    }

    public function setAnmlCode(?string $anmlCode): self
    {
        $this->anmlCode = $anmlCode;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getAnmlLibelle();
    }

    public function getCtAnomalieType(): ?CtAnomalieType
    {
        return $this->ctAnomalieType;
    }

    public function setCtAnomalieType(?CtAnomalieType $ctAnomalieType): self
    {
        $this->ctAnomalieType = $ctAnomalieType;

        return $this;
    }


}
