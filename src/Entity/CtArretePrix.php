<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtArretePrix
 *
 * @ORM\Table(name="ct_arrete_prix", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_1CEB5E02BAE5AA62A3BE41E55D485823", columns={"art_numero", "art_date", "art_date_applic"})}, indexes={@ORM\Index(name="IDX_1CEB5E02C211A85D", columns={"ct_user_id"})})
 * @ORM\Entity
 */
class CtArretePrix
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
     * @var string
     *
     * @ORM\Column(name="art_numero", type="string", length=124, nullable=false)
     */
    private $artNumero;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="art_date", type="date", nullable=true, options={"default"="NULL"})
     */
    private $artDate = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="art_date_applic", type="date", nullable=true, options={"default"="NULL"})
     */
    private $artDateApplic = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="art_created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $artCreatedAt = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="art_updated_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $artUpdatedAt = 'NULL';

    /**
     * @var \CtUser
     *
     * @ORM\ManyToOne(targetEntity="CtUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_user_id", referencedColumnName="id")
     * })
     */
    private $ctUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtNumero(): ?string
    {
        return $this->artNumero;
    }

    public function setArtNumero(string $artNumero): self
    {
        $this->artNumero = $artNumero;

        return $this;
    }

    public function getArtDate(): ?\DateTimeInterface
    {
        return $this->artDate;
    }

    public function setArtDate(?\DateTimeInterface $artDate): self
    {
        $this->artDate = $artDate;

        return $this;
    }

    public function getArtDateApplic(): ?\DateTimeInterface
    {
        return $this->artDateApplic;
    }

    public function setArtDateApplic(?\DateTimeInterface $artDateApplic): self
    {
        $this->artDateApplic = $artDateApplic;

        return $this;
    }

    public function getArtCreatedAt(): ?\DateTimeInterface
    {
        return $this->artCreatedAt;
    }

    public function setArtCreatedAt(?\DateTimeInterface $artCreatedAt): self
    {
        $this->artCreatedAt = $artCreatedAt;

        return $this;
    }

    public function getArtUpdatedAt(): ?\DateTimeInterface
    {
        return $this->artUpdatedAt;
    }

    public function setArtUpdatedAt(?\DateTimeInterface $artUpdatedAt): self
    {
        $this->artUpdatedAt = $artUpdatedAt;

        return $this;
    }

    public function getCtUser(): ?CtUser
    {
        return $this->ctUser;
    }

    public function setCtUser(?CtUser $ctUser): self
    {
        $this->ctUser = $ctUser;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getArtNumero();
    }


}
