<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtAnomalieType
 *
 * @ORM\Table(name="ct_anomalie_type")
 * @ORM\Entity
 */
class CtAnomalieType
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
     * @ORM\Column(name="atp_libelle", type="string", length=45, nullable=true)
     */
    private $atpLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAtpLibelle(): ?string
    {
        return $this->atpLibelle;
    }

    public function setAtpLibelle(?string $atpLibelle): self
    {
        $this->atpLibelle = $atpLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getAtpLibelle();
    }


}
