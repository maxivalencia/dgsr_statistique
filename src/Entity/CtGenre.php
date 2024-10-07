<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtGenre
 *
 * @ORM\Table(name="ct_genre", indexes={@ORM\Index(name="IDX_9BCBF2CE12DA9529", columns={"ct_genre_categorie_id"})})
 * @ORM\Entity
 */
class CtGenre
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
     * @ORM\Column(name="gr_libelle", type="string", length=255, nullable=true)
     */
    private $grLibelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gr_code", type="string", length=50, nullable=true)
     */
    private $grCode;

    /**
     * @var \CtGenreCategorie
     *
     * @ORM\ManyToOne(targetEntity="CtGenreCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_genre_categorie_id", referencedColumnName="id")
     * })
     */
    private $ctGenreCategorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrLibelle(): ?string
    {
        return $this->grLibelle;
    }

    public function setGrLibelle(?string $grLibelle): self
    {
        $this->grLibelle = $grLibelle;

        return $this;
    }

    public function getGrCode(): ?string
    {
        return $this->grCode;
    }

    public function setGrCode(?string $grCode): self
    {
        $this->grCode = $grCode;

        return $this;
    }

    public function getCtGenreCategorie(): ?CtGenreCategorie
    {
        return $this->ctGenreCategorie;
    }

    public function setCtGenreCategorie(?CtGenreCategorie $ctGenreCategorie): self
    {
        $this->ctGenreCategorie = $ctGenreCategorie;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getGrLibelle();
    }


}
