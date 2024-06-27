<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtGenreCategorie
 *
 * @ORM\Table(name="ct_genre_categorie")
 * @ORM\Entity
 */
class CtGenreCategorie
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
     * @ORM\Column(name="gc_libelle", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $gcLibelle = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="gc_is_calculable", type="boolean", nullable=false)
     */
    private $gcIsCalculable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGcLibelle(): ?string
    {
        return $this->gcLibelle;
    }

    public function setGcLibelle(?string $gcLibelle): self
    {
        $this->gcLibelle = $gcLibelle;

        return $this;
    }

    public function getGcIsCalculable(): ?bool
    {
        return $this->gcIsCalculable;
    }

    public function setGcIsCalculable(bool $gcIsCalculable): self
    {
        $this->gcIsCalculable = $gcIsCalculable;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getGcLibelle();
    }


}
