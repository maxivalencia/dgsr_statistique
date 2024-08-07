<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtMarque
 *
 * @ORM\Table(name="ct_marque")
 * @ORM\Entity
 */
class CtMarque
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
     * @ORM\Column(name="mrq_libelle", type="string", length=255, nullable=true)
     */
    private $mrqLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMrqLibelle(): ?string
    {
        return $this->mrqLibelle;
    }

    public function setMrqLibelle(?string $mrqLibelle): self
    {
        $this->mrqLibelle = $mrqLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getMrqLibelle();
    }


}
