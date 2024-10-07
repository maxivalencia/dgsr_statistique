<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtUtilisation
 *
 * @ORM\Table(name="ct_utilisation")
 * @ORM\Entity
 */
class CtUtilisation
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
     * @ORM\Column(name="ut_libelle", type="string", length=45, nullable=true)
     */
    private $utLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtLibelle(): ?string
    {
        return $this->utLibelle;
    }

    public function setUtLibelle(?string $utLibelle): self
    {
        $this->utLibelle = $utLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getUtLibelle();
    }


}
