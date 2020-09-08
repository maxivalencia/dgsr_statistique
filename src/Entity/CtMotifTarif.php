<?php

namespace App\Entity;

use App\Entity\CtMotif;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CtMotifTarif
 *
 * @ORM\Table(name="ct_motif_tarif", uniqueConstraints={@ORM\UniqueConstraint(name="uk_ct_motif_ct_mtf_trf_date", columns={"mtf_trf_date", "ct_motif_id"})}, indexes={@ORM\Index(name="fk_ct_motif_tarif_ct_motif1_idx", columns={"ct_motif_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CtMotifTarifRepository")
 */
class CtMotifTarif
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
     * @ORM\Column(name="mtf_trf_prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $mtfTrfPrix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mtf_trf_date", type="string", length=4, nullable=true)
     */
    private $mtfTrfDate;

    /**
     * @var \CtMotif
     *
     * @ORM\ManyToOne(targetEntity="CtMotif")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_motif_id", referencedColumnName="id")
     * })
     */
    private $ctMotif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMtfTrfPrix(): ?float
    {
        return $this->mtfTrfPrix;
    }

    public function setMtfTrfPrix(?float $mtfTrfPrix): self
    {
        $this->mtfTrfPrix = $mtfTrfPrix;

        return $this;
    }

    public function getMtfTrfDate(): ?string
    {
        return $this->mtfTrfDate;
    }

    public function setMtfTrfDate(?string $mtfTrfDate): self
    {
        $this->mtfTrfDate = $mtfTrfDate;

        return $this;
    }

    public function getCtMotif(): ?CtMotif
    {
        return $this->ctMotif;
    }

    public function setCtMotif(?CtMotif $ctMotif): self
    {
        $this->ctMotif = $ctMotif;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getMtfTrfPrix();
    }


}
