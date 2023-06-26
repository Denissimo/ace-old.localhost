<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserEmailRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\UuidV6;

#[ORM\Entity(repositoryClass: UserEmailRepository::class)]
#[ApiResource]
class UserEmail
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private UuidV6 $id;

    #[ORM\Column(length: 255)]
    private string $email;

    #[ORM\Column]
    private ?bool $isMain = null;

    #[ORM\Column(
        type: 'datetime_immutable',
        nullable: true
    )]
    private ?DateTimeImmutable $verified = null;

    #[ORM\Column(
        type: 'datetime_immutable',
        nullable: false
    )]
    #[Gedmo\Timestampable(on:"create")]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(
        type: 'datetime_immutable',
        nullable: true
    )]
    #[Gedmo\Timestampable(on:"update")]
    private ?DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'userEmails')]
    private ?User $user = null;

    public function getId(): UuidV6
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function isMain(): ?bool
    {
        return $this->isMain;
    }

    public function setIsMain(bool $isMain): static
    {
        $this->isMain = $isMain;

        return $this;
    }

    public function getVerified(): ?DateTimeImmutable
    {
        return $this->verified;
    }

    public function setVerified(?DateTimeImmutable $verified = null): static
    {
        $this->verified = $verified;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
