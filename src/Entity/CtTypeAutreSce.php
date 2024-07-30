<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtTypeAutreSce
 *
 * @ORM\Table(name="ct_type_autre_sce")
 * @ORM\Entity
 */
class CtTypeAutreSce
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
     * @ORM\Column(name="tpas_libelle", type="string", length=45, nullable=true)
     */
    private $tpasLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTpasLibelle(): ?string
    {
        return $this->tpasLibelle;
    }

    public function setTpasLibelle(?string $tpasLibelle): self
    {
        $this->tpasLibelle = $tpasLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getTpasLibelle();
    }


}
