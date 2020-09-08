<?php

namespace App\Entity;

use App\Entity\CtUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CtHistorique
 *
 * @ORM\Table(name="ct_historique", indexes={@ORM\Index(name="IDX_7E72DEE1C211A85D", columns={"ct_user_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CtHistoriqueRepository")
 */
class CtHistorique
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
     * @ORM\Column(name="hst_description", type="text", length=0, nullable=false)
     */
    private $hstDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hst_date_create", type="datetime", nullable=false)
     */
    private $hstDateCreate;

    /**
     * @var bool
     *
     * @ORM\Column(name="hst_is_view", type="boolean", nullable=false)
     */
    private $hstIsView;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ct_centre_id", type="integer", nullable=true)
     */
    private $ctCentreId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hist_type", type="string", length=20, nullable=true)
     */
    private $histType;

    /**
     * @var \CtUser
     *
     * @ORM\ManyToOne(targetEntity="CtUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_user_id", referencedColumnName="id")
     * })
     */
    private $ctUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHstDescription(): ?string
    {
        return $this->hstDescription;
    }

    public function setHstDescription(string $hstDescription): self
    {
        $this->hstDescription = $hstDescription;

        return $this;
    }

    public function getHstDateCreate(): ?\DateTimeInterface
    {
        return $this->hstDateCreate;
    }

    public function setHstDateCreate(\DateTimeInterface $hstDateCreate): self
    {
        $this->hstDateCreate = $hstDateCreate;

        return $this;
    }

    public function getHstIsView(): ?bool
    {
        return $this->hstIsView;
    }

    public function setHstIsView(bool $hstIsView): self
    {
        $this->hstIsView = $hstIsView;

        return $this;
    }

    public function getCtCentreId(): ?int
    {
        return $this->ctCentreId;
    }

    public function setCtCentreId(?int $ctCentreId): self
    {
        $this->ctCentreId = $ctCentreId;

        return $this;
    }

    public function getHistType(): ?string
    {
        return $this->histType;
    }

    public function setHistType(?string $histType): self
    {
        $this->histType = $histType;

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
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getHstDescription();
    }


}
