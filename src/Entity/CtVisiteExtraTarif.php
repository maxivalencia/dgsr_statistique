<?php

namespace App\Entity;

use App\Entity\CtVisiteExtra;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CtVisiteExtraTarif
 *
 * @ORM\Table(name="ct_visite_extra_tarif", uniqueConstraints={@ORM\UniqueConstraint(name="uk_ct_visite_extra_ct_vet_annee", columns={"vet_annee", "ct_visite_extra_id"})}, indexes={@ORM\Index(name="fk_ct_visite_extra_tarif_ct_visite_extra1_idx", columns={"ct_visite_extra_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CtVisiteExtraTarifRepository")
 */
class CtVisiteExtraTarif
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
     * @ORM\Column(name="vet_annee", type="string", length=4, nullable=true)
     */
    private $vetAnnee;

    /**
     * @var float|null
     *
     * @ORM\Column(name="vet_prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $vetPrix;

    /**
     * @var \CtVisiteExtra
     *
     * @ORM\ManyToOne(targetEntity="CtVisiteExtra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_visite_extra_id", referencedColumnName="id")
     * })
     */
    private $ctVisiteExtra;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVetAnnee(): ?string
    {
        return $this->vetAnnee;
    }

    public function setVetAnnee(?string $vetAnnee): self
    {
        $this->vetAnnee = $vetAnnee;

        return $this;
    }

    public function getVetPrix(): ?float
    {
        return $this->vetPrix;
    }

    public function setVetPrix(?float $vetPrix): self
    {
        $this->vetPrix = $vetPrix;

        return $this;
    }

    public function getCtVisiteExtra(): ?CtVisiteExtra
    {
        return $this->ctVisiteExtra;
    }

    public function setCtVisiteExtra(?CtVisiteExtra $ctVisiteExtra): self
    {
        $this->ctVisiteExtra = $ctVisiteExtra;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getVetPrix();
    }


}
