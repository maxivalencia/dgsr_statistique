<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtSourceEnergie
 *
 * @ORM\Table(name="ct_source_energie")
 * @ORM\Entity(repositoryClass="App\Repository\CtSourceEnergieRepository")
 */
class CtSourceEnergie
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
     * @ORM\Column(name="sre_libelle", type="string", length=255, nullable=true)
     */
    private $sreLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSreLibelle(): ?string
    {
        return $this->sreLibelle;
    }

    public function setSreLibelle(?string $sreLibelle): self
    {
        $this->sreLibelle = $sreLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getSreLibelle();
    }


}
