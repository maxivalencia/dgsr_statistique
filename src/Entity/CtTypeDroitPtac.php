<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtTypeDroitPtac
 *
 * @ORM\Table(name="ct_type_droit_ptac")
 * @ORM\Entity(repositoryClass="App\Repository\CtTypeDroitPtacRepository")
 */
class CtTypeDroitPtac
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
     * @ORM\Column(name="tp_dp_libelle", type="string", length=45, nullable=true)
     */
    private $tpDpLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTpDpLibelle(): ?string
    {
        return $this->tpDpLibelle;
    }

    public function setTpDpLibelle(?string $tpDpLibelle): self
    {
        $this->tpDpLibelle = $tpDpLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getTpDpLibelle();
    }


}
