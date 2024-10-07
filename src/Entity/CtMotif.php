<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtMotif
 *
 * @ORM\Table(name="ct_motif")
 * @ORM\Entity
 */
class CtMotif
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
     * @ORM\Column(name="mtf_libelle", type="string", length=255, nullable=true)
     */
    private $mtfLibelle;

    /**
     * @var bool
     *
     * @ORM\Column(name="mtf_is_calculable", type="boolean", nullable=false)
     */
    private $mtfIsCalculable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMtfLibelle(): ?string
    {
        return $this->mtfLibelle;
    }

    public function setMtfLibelle(?string $mtfLibelle): self
    {
        $this->mtfLibelle = $mtfLibelle;

        return $this;
    }

    public function getMtfIsCalculable(): ?bool
    {
        return $this->mtfIsCalculable;
    }

    public function setMtfIsCalculable(bool $mtfIsCalculable): self
    {
        $this->mtfIsCalculable = $mtfIsCalculable;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getMtfLibelle();
    }


}
