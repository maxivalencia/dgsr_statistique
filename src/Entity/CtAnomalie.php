<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtAnomalie
 *
 * @ORM\Table(name="ct_anomalie", indexes={@ORM\Index(name="fk_ct_anomalie_ct_anomalie_type1_idx", columns={"ct_anomalie_type_id"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
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
     * @ORM\Column(name="anml_libelle", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $anmlLibelle = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="anml_code", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $anmlCode = 'NULL';

    /**
     * @var \CtAnomalieType
     *
     * @ORM\ManyToOne(targetEntity="CtAnomalieType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_anomalie_type_id", referencedColumnName="id")
     * })
     */
    private $ctAnomalieType;

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

    public function getCtAnomalieType(): ?CtAnomalieType
    {
        return $this->ctAnomalieType;
    }

    public function setCtAnomalieType(?CtAnomalieType $ctAnomalieType): self
    {
        $this->ctAnomalieType = $ctAnomalieType;

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


}
