<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtVisiteAnomalie
 *
 * @ORM\Table(name="ct_visite_anomalie")
 * @ORM\Entity
 */
class CtVisiteAnomalie
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
     * @var int
     *
     * @ORM\Column(name="ct_anomalie_id", type="integer", nullable=false)
     */
    private $ctAnomalieId;

    /**
     * @var int
     *
     * @ORM\Column(name="ct_visite_id", type="integer", nullable=false)
     */
    private $ctVisiteId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtAnomalieId(): ?int
    {
        return $this->ctAnomalieId;
    }

    public function setCtAnomalieId(int $ctAnomalieId): self
    {
        $this->ctAnomalieId = $ctAnomalieId;

        return $this;
    }

    public function getCtVisiteId(): ?int
    {
        return $this->ctVisiteId;
    }

    public function setCtVisiteId(int $ctVisiteId): self
    {
        $this->ctVisiteId = $ctVisiteId;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCtAnomalieId();
    }


}
