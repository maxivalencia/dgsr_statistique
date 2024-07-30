<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtProvince
 *
 * @ORM\Table(name="ct_province")
 * @ORM\Entity
 */
class CtProvince
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
     * @ORM\Column(name="prv_nom", type="string", length=255, nullable=true)
     */
    private $prvNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prv_code", type="string", length=255, nullable=true)
     */
    private $prvCode;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="prv_created_at", type="datetime", nullable=true)
     */
    private $prvCreatedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="prv_updated_at", type="datetime", nullable=true)
     */
    private $prvUpdatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrvNom(): ?string
    {
        return $this->prvNom;
    }

    public function setPrvNom(?string $prvNom): self
    {
        $this->prvNom = $prvNom;

        return $this;
    }

    public function getPrvCode(): ?string
    {
        return $this->prvCode;
    }

    public function setPrvCode(?string $prvCode): self
    {
        $this->prvCode = $prvCode;

        return $this;
    }

    public function getPrvCreatedAt(): ?\DateTimeInterface
    {
        return $this->prvCreatedAt;
    }

    public function setPrvCreatedAt(?\DateTimeInterface $prvCreatedAt): self
    {
        $this->prvCreatedAt = $prvCreatedAt;

        return $this;
    }

    public function getPrvUpdatedAt(): ?\DateTimeInterface
    {
        return $this->prvUpdatedAt;
    }

    public function setPrvUpdatedAt(?\DateTimeInterface $prvUpdatedAt): self
    {
        $this->prvUpdatedAt = $prvUpdatedAt;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getPrvNom();
    }


}
