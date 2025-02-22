<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTimeImmutable;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Uid\UuidV6;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private UuidV6 $id;

    #[ORM\Column(length: 180, unique: true)]
    private string $username;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private string $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserEmail::class)]
    private Collection $userEmails;

    #[ORM\Column(
        type: 'datetime_immutable',
        nullable: false,
        options: ['default'=>'CURRENT_TIMESTAMP']
    )]
    #[Gedmo\Timestampable(on:"create")]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(
        type: 'datetime_immutable',
        nullable: true,
        options: ['default'=>'CURRENT_TIMESTAMP']
    )]
    #[Gedmo\Timestampable(on:"update")]
    private ?DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'partner', targetEntity: IpRange::class)]
    private Collection $ipRanges;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Partner $partner = null;

    public function __construct()
    {
        $this->userEmails = new ArrayCollection();
        $this->ipRanges = new ArrayCollection();
    }

    public function getId(): UuidV6
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, UserEmail>
     */
    public function getUserEmails(): Collection
    {
        return $this->userEmails;
    }

    /**
     * @return UserEmail|null
     */
    public function getUserEmail(): ?UserEmail
    {
        $email = $this->userEmails->current();

        return $email instanceof UserEmail ? $email : null;
    }

    public function addUserEmail(UserEmail $userEmail): static
    {
        if (!$this->userEmails->contains($userEmail)) {
            $this->userEmails->add($userEmail);
            $userEmail->setUser($this);
        }

        return $this;
    }

    public function removeUserEmail(UserEmail $userEmail): static
    {
        if ($this->userEmails->removeElement($userEmail)) {
            // set the owning side to null (unless already changed)
            if ($userEmail->getUser() === $this) {
                $userEmail->setUser(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, IpRange>
     */
    public function getIpRanges(): Collection
    {
        return $this->ipRanges;
    }

    public function addIpRange(IpRange $ipRange): static
    {
        if (!$this->ipRanges->contains($ipRange)) {
            $this->ipRanges->add($ipRange);
            $ipRange->setPartner($this);
        }

        return $this;
    }

    public function removeIpRange(IpRange $ipRange): static
    {
        if ($this->ipRanges->removeElement($ipRange)) {
            // set the owning side to null (unless already changed)
            if ($ipRange->getPartner() === $this) {
                $ipRange->setPartner(null);
            }
        }

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): static
    {
        $this->partner = $partner;

        return $this;
    }
}
