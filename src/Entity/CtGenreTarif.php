<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtGenreTarif
 *
 * @ORM\Table(name="ct_genre_tarif", uniqueConstraints={@ORM\UniqueConstraint(name="uk_ct_genre_ct_annee", columns={"grt_annee", "ct_genre_id"})}, indexes={@ORM\Index(name="fk_ct_genre_tarif_ct_genre1_idx", columns={"ct_genre_id"})})
 * @ORM\Entity
 */
class CtGenreTarif
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
     * @var float|null
     *
     * @ORM\Column(name="grt_prix", type="float", precision=10, scale=0, nullable=true, options={"default"="NULL"})
     */
    private $grtPrix = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="grt_annee", type="string", length=4, nullable=true, options={"default"="NULL"})
     */
    private $grtAnnee = 'NULL';

    /**
     * @var \CtGenre
     *
     * @ORM\ManyToOne(targetEntity="CtGenre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_genre_id", referencedColumnName="id")
     * })
     */
    private $ctGenre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrtPrix(): ?float
    {
        return $this->grtPrix;
    }

    public function setGrtPrix(?float $grtPrix): self
    {
        $this->grtPrix = $grtPrix;

        return $this;
    }

    public function getGrtAnnee(): ?string
    {
        return $this->grtAnnee;
    }

    public function setGrtAnnee(?string $grtAnnee): self
    {
        $this->grtAnnee = $grtAnnee;

        return $this;
    }

    public function getCtGenre(): ?CtGenre
    {
        return $this->ctGenre;
    }

    public function setCtGenre(?CtGenre $ctGenre): self
    {
        $this->ctGenre = $ctGenre;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getCtGenre();
    }


}
