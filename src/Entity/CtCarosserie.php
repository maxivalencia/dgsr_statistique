<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtCarosserie
 *
 * @ORM\Table(name="ct_carosserie")
 * @ORM\Entity
 */
class CtCarosserie
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
     * @ORM\Column(name="crs_libelle", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $crsLibelle = 'NULL';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCrsLibelle(): ?string
    {
        return $this->crsLibelle;
    }

    public function setCrsLibelle(?string $crsLibelle): self
    {
        $this->crsLibelle = $crsLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCrsLibelle();
    }


}
