<?php

namespace App\Entity;

use App\Repository\IpRangeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use DateTimeImmutable;
use Symfony\Component\Uid\UuidV6;

#[ORM\Entity(repositoryClass: IpRangeRepository::class)]
class IpRange
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private UuidV6 $id;

    #[ORM\Column]
    private int $ip_from;

    #[ORM\Column(nullable: true)]
    private ?int $ip_to = null;

    #[ORM\ManyToOne(inversedBy: 'ipRanges')]
    private ?User $partner = null;

    #[ORM\Column(
        type: 'datetime_immutable',
        nullable: false
    )]
    #[Gedmo\Timestampable(on:"create")]
    private DateTimeImmutable $created_at;

    #[ORM\Column(
        type: 'datetime_immutable',
        nullable: true,
        options: ['default'=>'CURRENT_TIMESTAMP']
    )]
    #[Gedmo\Timestampable(on:"update")]
    private ?DateTimeImmutable $updated_at = null;

    public function getId(): UuidV6
    {
        return $this->id;
    }

    public function getIpFrom(): ?int
    {
        return $this->ip_from;
    }

    public function setIpFrom(int $ip_from): static
    {
        $this->ip_from = $ip_from;

        return $this;
    }

    public function getIpTo(): ?int
    {
        return $this->ip_to;
    }

    public function setIpTo(?int $ip_to): static
    {
        $this->ip_to = $ip_to;

        return $this;
    }

    public function getPartner(): ?User
    {
        return $this->partner;
    }

    public function setPartner(?User $partner): static
    {
        $this->partner = $partner;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?DateTimeImmutable $updated_at = null): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
