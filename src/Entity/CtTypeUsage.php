<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtTypeUsage
 *
 * @ORM\Table(name="ct_type_usage")
 * @ORM\Entity(repositoryClass="App\Repository\CtTypeUsageRepository")
 */
class CtTypeUsage
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
     * @ORM\Column(name="tpu_libelle", type="string", length=45, nullable=false)
     */
    private $tpuLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTpuLibelle(): ?string
    {
        return $this->tpuLibelle;
    }

    public function setTpuLibelle(string $tpuLibelle): self
    {
        $this->tpuLibelle = $tpuLibelle;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getTpuLibelle();
    }


}
