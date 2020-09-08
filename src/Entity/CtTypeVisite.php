<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtTypeVisite
 *
 * @ORM\Table(name="ct_type_visite")
 * @ORM\Entity(repositoryClass="App\Repository\CtTypeVisiteRepository")
 */
class CtTypeVisite
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
     * @ORM\Column(name="tpv_libelle", type="string", length=45, nullable=true)
     */
    private $tpvLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTpvLibelle(): ?string
    {
        return $this->tpvLibelle;
    }

    public function setTpvLibelle(?string $tpvLibelle): self
    {
        $this->tpvLibelle = $tpvLibelle;

        return $this;
    }


    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getTpvLibelle();
    }

}
