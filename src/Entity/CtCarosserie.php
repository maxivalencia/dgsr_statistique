<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtCarosserie
 *
 * @ORM\Table(name="ct_carosserie")
 * @ORM\Entity(repositoryClass="App\Repository\CtCarosserieRepository")
 */
class CtCarosserie
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
     * @ORM\Column(name="crs_libelle", type="string", length=255, nullable=true)
     */
    private $crsLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCrsLibelle(): ?string
    {
        return $this->crsLibelle;
    }

    public function setCrsLibelle(?string $crsLibelle): self
    {
        $this->crsLibelle = $crsLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCrsLibelle();
    }


}
