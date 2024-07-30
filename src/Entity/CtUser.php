<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * CtUser
 *
 * @ORM\Table(name="ct_user", uniqueConstraints={@ORM\UniqueConstraint(name="username_canonical_UNIQUE", columns={"username_canonical"}), @ORM\UniqueConstraint(name="email_canonical_UNIQUE", columns={"email_canonical"}), @ORM\UniqueConstraint(name="confirmation_token_UNIQUE", columns={"confirmation_token"})}, indexes={@ORM\Index(name="IDX_A115979E82C8474E", columns={"ct_centre_id"}), @ORM\Index(name="IDX_A115979EB37C5964", columns={"ct_role_id"})})
 * @ORM\Entity
 */
class CtUser
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
     * @ORM\Column(name="username", type="string", length=180, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="username_canonical", type="string", length=180, nullable=false)
     */
    private $usernameCanonical;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=180, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="email_canonical", type="string", length=180, nullable=false)
     */
    private $emailCanonical;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var string|null
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="confirmation_token", type="string", length=180, nullable=true)
     */
    private $confirmationToken;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="password_requested_at", type="datetime", nullable=true)
     */
    private $passwordRequestedAt;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", length=0, nullable=false)
     */
    private $roles;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usr_name", type="string", length=255, nullable=true)
     */
    private $usrName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usr_email", type="string", length=255, nullable=true)
     */
    private $usrEmail;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="usr_locked", type="boolean", nullable=true)
     */
    private $usrLocked;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usr_password", type="string", length=255, nullable=true)
     */
    private $usrPassword;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usr_adresse", type="string", length=255, nullable=true)
     */
    private $usrAdresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usr_token", type="string", length=100, nullable=true)
     */
    private $usrToken;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="usr_created_at", type="datetime", nullable=true)
     */
    private $usrCreatedAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="usr_updated_at", type="datetime", nullable=true)
     */
    private $usrUpdatedAt;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="usr_locked_update", type="boolean", nullable=true)
     */
    private $usrLockedUpdate;

    /**
     * @var bool
     *
     * @ORM\Column(name="usr_request_update", type="boolean", nullable=false)
     */
    private $usrRequestUpdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usr_profession", type="string", length=255, nullable=true)
     */
    private $usrProfession;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usr_telephone", type="string", length=45, nullable=true)
     */
    private $usrTelephone;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="usr_is_connected", type="boolean", nullable=true)
     */
    private $usrIsConnected;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="usr_presence", type="boolean", nullable=true)
     */
    private $usrPresence;

    /**
     * @var \CtCentre
     *
     * @ORM\ManyToOne(targetEntity="CtCentre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_centre_id", referencedColumnName="id")
     * })
     */
    private $ctCentre;

    /**
     * @var \CtRole
     *
     * @ORM\ManyToOne(targetEntity="CtRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_role_id", referencedColumnName="id")
     * })
     */
    private $ctRole;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUsernameCanonical(): ?string
    {
        return $this->usernameCanonical;
    }

    public function setUsernameCanonical(string $usernameCanonical): self
    {
        $this->usernameCanonical = $usernameCanonical;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailCanonical(): ?string
    {
        return $this->emailCanonical;
    }

    public function setEmailCanonical(string $emailCanonical): self
    {
        $this->emailCanonical = $emailCanonical;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    public function setSalt(?string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    public function getPasswordRequestedAt(): ?\DateTimeInterface
    {
        return $this->passwordRequestedAt;
    }

    public function setPasswordRequestedAt(?\DateTimeInterface $passwordRequestedAt): self
    {
        $this->passwordRequestedAt = $passwordRequestedAt;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getUsrName(): ?string
    {
        return $this->usrName;
    }

    public function setUsrName(?string $usrName): self
    {
        $this->usrName = $usrName;

        return $this;
    }

    public function getUsrEmail(): ?string
    {
        return $this->usrEmail;
    }

    public function setUsrEmail(?string $usrEmail): self
    {
        $this->usrEmail = $usrEmail;

        return $this;
    }

    public function getUsrLocked(): ?bool
    {
        return $this->usrLocked;
    }

    public function setUsrLocked(?bool $usrLocked): self
    {
        $this->usrLocked = $usrLocked;

        return $this;
    }

    public function getUsrPassword(): ?string
    {
        return $this->usrPassword;
    }

    public function setUsrPassword(?string $usrPassword): self
    {
        $this->usrPassword = $usrPassword;

        return $this;
    }

    public function getUsrAdresse(): ?string
    {
        return $this->usrAdresse;
    }

    public function setUsrAdresse(?string $usrAdresse): self
    {
        $this->usrAdresse = $usrAdresse;

        return $this;
    }

    public function getUsrToken(): ?string
    {
        return $this->usrToken;
    }

    public function setUsrToken(?string $usrToken): self
    {
        $this->usrToken = $usrToken;

        return $this;
    }

    public function getUsrCreatedAt(): ?\DateTimeInterface
    {
        return $this->usrCreatedAt;
    }

    public function setUsrCreatedAt(?\DateTimeInterface $usrCreatedAt): self
    {
        $this->usrCreatedAt = $usrCreatedAt;

        return $this;
    }

    public function getUsrUpdatedAt(): ?\DateTimeInterface
    {
        return $this->usrUpdatedAt;
    }

    public function setUsrUpdatedAt(?\DateTimeInterface $usrUpdatedAt): self
    {
        $this->usrUpdatedAt = $usrUpdatedAt;

        return $this;
    }

    public function getUsrLockedUpdate(): ?bool
    {
        return $this->usrLockedUpdate;
    }

    public function setUsrLockedUpdate(?bool $usrLockedUpdate): self
    {
        $this->usrLockedUpdate = $usrLockedUpdate;

        return $this;
    }

    public function getUsrRequestUpdate(): ?bool
    {
        return $this->usrRequestUpdate;
    }

    public function setUsrRequestUpdate(bool $usrRequestUpdate): self
    {
        $this->usrRequestUpdate = $usrRequestUpdate;

        return $this;
    }

    public function getUsrProfession(): ?string
    {
        return $this->usrProfession;
    }

    public function setUsrProfession(?string $usrProfession): self
    {
        $this->usrProfession = $usrProfession;

        return $this;
    }

    public function getUsrTelephone(): ?string
    {
        return $this->usrTelephone;
    }

    public function setUsrTelephone(?string $usrTelephone): self
    {
        $this->usrTelephone = $usrTelephone;

        return $this;
    }

    public function getUsrIsConnected(): ?bool
    {
        return $this->usrIsConnected;
    }

    public function setUsrIsConnected(?bool $usrIsConnected): self
    {
        $this->usrIsConnected = $usrIsConnected;

        return $this;
    }

    public function getUsrPresence(): ?bool
    {
        return $this->usrPresence;
    }

    public function setUsrPresence(?bool $usrPresence): self
    {
        $this->usrPresence = $usrPresence;

        return $this;
    }

    public function getCtCentre(): ?CtCentre
    {
        return $this->ctCentre;
    }

    public function setCtCentre(?CtCentre $ctCentre): self
    {
        $this->ctCentre = $ctCentre;

        return $this;
    }

    public function getCtRole(): ?CtRole
    {
        return $this->ctRole;
    }

    public function setCtRole(?CtRole $ctRole): self
    {
        $this->ctRole = $ctRole;

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getUsrName();
    }


}
