<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtConstAvDedType
 *
 * @ORM\Table(name="ct_const_av_ded_type")
 * @ORM\Entity(repositoryClass="App\Repository\CtAvDedTypeRepository")
 */
class CtConstAvDedType
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
     * @ORM\Column(name="cad_tp_libelle", type="string", length=45, nullable=true)
     */
    private $cadTpLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCadTpLibelle(): ?string
    {
        return $this->cadTpLibelle;
    }

    public function setCadTpLibelle(?string $cadTpLibelle): self
    {
        $this->cadTpLibelle = $cadTpLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCadTpLibelle();
    }


}
