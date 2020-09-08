<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtDroitPtacBak
 *
 * @ORM\Table(name="ct_droit_ptac_bak", indexes={@ORM\Index(name="IDX_DB918ADA7CFDF4AC", columns={"ct_type_droit_ptac_id"}), @ORM\Index(name="IDX_DB918ADA12DA9529", columns={"ct_genre_categorie_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CtDroitPtacBakRepository")
 */
class CtDroitPtacBak
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
     * @var int|null
     *
     * @ORM\Column(name="ct_genre_categorie_id", type="integer", nullable=true)
     */
    private $ctGenreCategorieId;

    /**
     * @var float|null
     *
     * @ORM\Column(name="dp_prix_min", type="float", precision=10, scale=0, nullable=true)
     */
    private $dpPrixMin;

    /**
     * @var float|null
     *
     * @ORM\Column(name="dp_prix_max", type="float", precision=10, scale=0, nullable=true)
     */
    private $dpPrixMax;

    /**
     * @var float|null
     *
     * @ORM\Column(name="dp_droit", type="float", precision=10, scale=0, nullable=true)
     */
    private $dpDroit;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_type_droit_ptac_id", type="integer", nullable=true)
     */
    private $ctTypeDroitPtacId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtGenreCategorieId(): ?int
    {
        return $this->ctGenreCategorieId;
    }

    public function setCtGenreCategorieId(?int $ctGenreCategorieId): self
    {
        $this->ctGenreCategorieId = $ctGenreCategorieId;

        return $this;
    }

    public function getDpPrixMin(): ?float
    {
        return $this->dpPrixMin;
    }

    public function setDpPrixMin(?float $dpPrixMin): self
    {
        $this->dpPrixMin = $dpPrixMin;

        return $this;
    }

    public function getDpPrixMax(): ?float
    {
        return $this->dpPrixMax;
    }

    public function setDpPrixMax(?float $dpPrixMax): self
    {
        $this->dpPrixMax = $dpPrixMax;

        return $this;
    }

    public function getDpDroit(): ?float
    {
        return $this->dpDroit;
    }

    public function setDpDroit(?float $dpDroit): self
    {
        $this->dpDroit = $dpDroit;

        return $this;
    }

    public function getCtTypeDroitPtacId(): ?int
    {
        return $this->ctTypeDroitPtacId;
    }

    public function setCtTypeDroitPtacId(?int $ctTypeDroitPtacId): self
    {
        $this->ctTypeDroitPtacId = $ctTypeDroitPtacId;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getDpDroit();
    }


}
