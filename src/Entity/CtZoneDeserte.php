<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtZoneDeserte
 *
 * @ORM\Table(name="ct_zone_deserte")
 * @ORM\Entity
 */
class CtZoneDeserte
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
     * @ORM\Column(name="zd_libelle", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $zdLibelle = 'NULL';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZdLibelle(): ?string
    {
        return $this->zdLibelle;
    }

    public function setZdLibelle(?string $zdLibelle): self
    {
        $this->zdLibelle = $zdLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getZdLibelle();
    }


}
