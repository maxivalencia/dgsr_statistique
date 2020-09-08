<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CtRole
 *
 * @ORM\Table(name="ct_role")
 * @ORM\Entity(repositoryClass="App\Repository\CtRoleRepository")
 */
class CtRole
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
     * @ORM\Column(name="role_name", type="string", length=45, nullable=true)
     */
    private $roleName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    public function setRoleName(?string $roleName): self
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getRoleName();
    }


}
