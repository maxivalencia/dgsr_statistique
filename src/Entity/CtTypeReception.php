<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtTypeReception
 *
 * @ORM\Table(name="ct_type_reception")
 * @ORM\Entity
 */
class CtTypeReception
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
     * @ORM\Column(name="tprcp_libelle", type="string", length=45, nullable=true)
     */
    private $tprcpLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTprcpLibelle(): ?string
    {
        return $this->tprcpLibelle;
    }

    public function setTprcpLibelle(?string $tprcpLibelle): self
    {
        $this->tprcpLibelle = $tprcpLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getTprcpLibelle();
    }


}
