<?php

namespace App\Entity;



use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtVisiteExtra
 *
 * @ORM\Table(name="ct_visite_extra")
 * @ORM\Entity
 */
class CtVisiteExtra
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
     * @ORM\Column(name="vste_libelle", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $vsteLibelle = 'NULL';

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CtVisite", inversedBy="ctVisiteExtra")
     * @ORM\JoinTable(name="ct_visite_visite_extra",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ct_visite_extra_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ct_visite_id", referencedColumnName="id")
     *   }
     * )
     */
    private $ctVisite;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ctVisite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVsteLibelle(): ?string
    {
        return $this->vsteLibelle;
    }

    public function setVsteLibelle(?string $vsteLibelle): self
    {
        $this->vsteLibelle = $vsteLibelle;

        return $this;
    }

    /**
     * @return Collection|CtVisite[]
     */
    public function getCtVisite(): Collection
    {
        return $this->ctVisite;
    }

    public function addCtVisite(CtVisite $ctVisite): self
    {
        if (!$this->ctVisite->contains($ctVisite)) {
            $this->ctVisite[] = $ctVisite;
        }

        return $this;
    }

    public function removeCtVisite(CtVisite $ctVisite): self
    {
        if ($this->ctVisite->contains($ctVisite)) {
            $this->ctVisite->removeElement($ctVisite);
        }

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getVsteLibelle();
    }

}
