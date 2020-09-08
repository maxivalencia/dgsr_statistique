<?php

namespace App\Entity;

use App\Entity\CtTypeDroitPtac;
use App\Entity\CtGenreCategorie;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CtDroitPtac
 *
 * @ORM\Table(name="ct_droit_ptac", indexes={@ORM\Index(name="IDX_DB918ADA7CFDF4AC", columns={"ct_type_droit_ptac_id"}), @ORM\Index(name="IDX_DB918ADA12DA9529", columns={"ct_genre_categorie_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CtDroitPtacRepository")
 */
class CtDroitPtac
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
     * @var \CtGenreCategorie
     *
     * @ORM\ManyToOne(targetEntity="CtGenreCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_genre_categorie_id", referencedColumnName="id")
     * })
     */
    private $ctGenreCategorie;

    /**
     * @var \CtTypeDroitPtac
     *
     * @ORM\ManyToOne(targetEntity="CtTypeDroitPtac")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_type_droit_ptac_id", referencedColumnName="id")
     * })
     */
    private $ctTypeDroitPtac;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCtGenreCategorie(): ?CtGenreCategorie
    {
        return $this->ctGenreCategorie;
    }

    public function setCtGenreCategorie(?CtGenreCategorie $ctGenreCategorie): self
    {
        $this->ctGenreCategorie = $ctGenreCategorie;

        return $this;
    }

    public function getCtTypeDroitPtac(): ?CtTypeDroitPtac
    {
        return $this->ctTypeDroitPtac;
    }

    public function setCtTypeDroitPtac(?CtTypeDroitPtac $ctTypeDroitPtac): self
    {
        $this->ctTypeDroitPtac = $ctTypeDroitPtac;

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
