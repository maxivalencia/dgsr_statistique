<?php

namespace App\Entity;



use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtImprimeTech
 *
 * @ORM\Table(name="ct_imprime_tech", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_3F49AE4290F3F714", columns={"nom_imprime_tech"})}, indexes={@ORM\Index(name="IDX_3F49AE42C211A85D", columns={"ct_user_id"})})
 * @ORM\Entity
 */
class CtImprimeTech
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
     * @var string
     *
     * @ORM\Column(name="nom_imprime_tech", type="string", length=128, nullable=false)
     */
    private $nomImprimeTech;

    /**
     * @var string
     *
     * @ORM\Column(name="ute_imprime_tech", type="string", length=64, nullable=false)
     */
    private $uteImprimeTech;

    /**
     * @var string|null
     *
     * @ORM\Column(name="abrev_imprime_tech", type="string", length=64, nullable=true, options={"default"="''"})
     */
    private $abrevImprimeTech = '\'\'';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="prtt_created_at", type="datetime", nullable=true)
     */
    private $prttCreatedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="prtt_updated_at", type="datetime", nullable=true)
     */
    private $prttUpdatedAt;

    /**
     * @var \CtUser
     *
     * @ORM\ManyToOne(targetEntity="CtUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_user_id", referencedColumnName="id")
     * })
     */
    private $ctUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CtAutreSce", mappedBy="ctImprimeTech")
     */
    private $ctAutreSce;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ctAutreSce = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomImprimeTech(): ?string
    {
        return $this->nomImprimeTech;
    }

    public function setNomImprimeTech(string $nomImprimeTech): self
    {
        $this->nomImprimeTech = $nomImprimeTech;

        return $this;
    }

    public function getUteImprimeTech(): ?string
    {
        return $this->uteImprimeTech;
    }

    public function setUteImprimeTech(string $uteImprimeTech): self
    {
        $this->uteImprimeTech = $uteImprimeTech;

        return $this;
    }

    public function getAbrevImprimeTech(): ?string
    {
        return $this->abrevImprimeTech;
    }

    public function setAbrevImprimeTech(?string $abrevImprimeTech): self
    {
        $this->abrevImprimeTech = $abrevImprimeTech;

        return $this;
    }

    public function getPrttCreatedAt(): ?\DateTimeInterface
    {
        return $this->prttCreatedAt;
    }

    public function setPrttCreatedAt(?\DateTimeInterface $prttCreatedAt): self
    {
        $this->prttCreatedAt = $prttCreatedAt;

        return $this;
    }

    public function getPrttUpdatedAt(): ?\DateTimeInterface
    {
        return $this->prttUpdatedAt;
    }

    public function setPrttUpdatedAt(?\DateTimeInterface $prttUpdatedAt): self
    {
        $this->prttUpdatedAt = $prttUpdatedAt;

        return $this;
    }

    public function getCtUser(): ?CtUser
    {
        return $this->ctUser;
    }

    public function setCtUser(?CtUser $ctUser): self
    {
        $this->ctUser = $ctUser;

        return $this;
    }

    /**
     * @return Collection|CtAutreSce[]
     */
    public function getCtAutreSce(): Collection
    {
        return $this->ctAutreSce;
    }

    public function addCtAutreSce(CtAutreSce $ctAutreSce): self
    {
        if (!$this->ctAutreSce->contains($ctAutreSce)) {
            $this->ctAutreSce[] = $ctAutreSce;
            $ctAutreSce->addCtImprimeTech($this);
        }

        return $this;
    }

    public function removeCtAutreSce(CtAutreSce $ctAutreSce): self
    {
        if ($this->ctAutreSce->contains($ctAutreSce)) {
            $this->ctAutreSce->removeElement($ctAutreSce);
            $ctAutreSce->removeCtImprimeTech($this);
        }

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getNomImprimeTech();
    }

}
