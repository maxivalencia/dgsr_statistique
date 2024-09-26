<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtUsageTarif
 *
 * @ORM\Table(name="ct_usage_tarif", uniqueConstraints={@ORM\UniqueConstraint(name="uk_ct_usage_ct_usg_trf_annee_ct_type_visite", columns={"usg_trf_annee", "ct_usage_id", "ct_type_visite_id"})}, indexes={@ORM\Index(name="fk_ct_usage_tarif_ct_usage1_idx", columns={"ct_usage_id"}), @ORM\Index(name="IDX_FA9D5B819C6EC188", columns={"ct_type_visite_id"}), @ORM\Index(name="IDX_FA9D5B8176255A68", columns={"ct_arrete_prix_id"})})
 * @ORM\Entity
 */
class CtUsageTarif
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
     * @ORM\Column(name="usg_trf_annee", type="string", length=4, nullable=true)
     */
    private $usgTrfAnnee;

    /**
     * @var float|null
     *
     * @ORM\Column(name="usg_trf_prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $usgTrfPrix;

    /**
     * @var \CtArretePrix
     *
     * @ORM\ManyToOne(targetEntity="CtArretePrix")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_arrete_prix_id", referencedColumnName="id")
     * })
     */
    private $ctArretePrix;

    /**
     * @var \CtTypeVisite
     *
     * @ORM\ManyToOne(targetEntity="CtTypeVisite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_type_visite_id", referencedColumnName="id")
     * })
     */
    private $ctTypeVisite;

    /**
     * @var \CtUsage
     *
     * @ORM\ManyToOne(targetEntity="CtUsage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_usage_id", referencedColumnName="id")
     * })
     */
    private $ctUsage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsgTrfAnnee(): ?string
    {
        return $this->usgTrfAnnee;
    }

    public function setUsgTrfAnnee(?string $usgTrfAnnee): self
    {
        $this->usgTrfAnnee = $usgTrfAnnee;

        return $this;
    }

    public function getUsgTrfPrix(): ?float
    {
        return $this->usgTrfPrix;
    }

    public function setUsgTrfPrix(?float $usgTrfPrix): self
    {
        $this->usgTrfPrix = $usgTrfPrix;

        return $this;
    }

    public function getCtArretePrix(): ?CtArretePrix
    {
        return $this->ctArretePrix;
    }

    public function setCtArretePrix(?CtArretePrix $ctArretePrix): self
    {
        $this->ctArretePrix = $ctArretePrix;

        return $this;
    }

    public function getCtTypeVisite(): ?CtTypeVisite
    {
        return $this->ctTypeVisite;
    }

    public function setCtTypeVisite(?CtTypeVisite $ctTypeVisite): self
    {
        $this->ctTypeVisite = $ctTypeVisite;

        return $this;
    }

    public function getCtUsage(): ?CtUsage
    {
        return $this->ctUsage;
    }

    public function setCtUsage(?CtUsage $ctUsage): self
    {
        $this->ctUsage = $ctUsage;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCtUsage();
    }


}
