<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtOptionVitreFumee
 *
 * @ORM\Table(name="ct_option_vitre_fumee")
 * @ORM\Entity
 */
class CtOptionVitreFumee
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
     * @ORM\Column(name="ovf_libelle", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $ovfLibelle = 'NULL';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOvfLibelle(): ?string
    {
        return $this->ovfLibelle;
    }

    public function setOvfLibelle(?string $ovfLibelle): self
    {
        $this->ovfLibelle = $ovfLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getOvfLibelle();
    }


}
