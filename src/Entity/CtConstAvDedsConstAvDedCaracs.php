<?php

namespace App\Entity;

use App\Repository\CtConstAvDedsConstAvDedCaracsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtConstAvDedsConstAvDedCaracsRepository::class)
 */
class CtConstAvDedsConstAvDedCaracs
{
    ///**
    // * @ORM\Id()
    // * @ORM\GeneratedValue()
    // * @ORM\Column(type="integer")
    // */
    /* private $id; */

    /**
     * @ORM\Column(type="integer")
     */
    private $const_av_ded_id;

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $const_av_ded_carac_id;

    /* public function getId(): ?int
    {
        return $this->id;
    } */

    public function getConstAvDedId(): ?int
    {
        return $this->const_av_ded_id;
    }

    public function setConstAvDedId(int $const_av_ded_id): self
    {
        $this->const_av_ded_id = $const_av_ded_id;

        return $this;
    }

    public function getConstAvDedCaracId(): ?int
    {
        return $this->const_av_ded_carac_id;
    }

    public function setConstAvDedCaracId(int $const_av_ded_carac_id): self
    {
        $this->const_av_ded_carac_id = $const_av_ded_carac_id;

        return $this;
    }
}
