<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Odm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Odm\Filter\RangeFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV6;
use DateTimeImmutable;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: TestRepository::class)]
//#[ApiResource(
//    paginationViaCursor: [
//        ['field' => 'id', 'direction' => 'DESC']
//    ],
//    paginationPartial: true
//)]
//#[ApiFilter(RangeFilter::class, properties: ["id"])]
//#[ApiFilter(OrderFilter::class, properties: ["id" => "DESC"])]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $number = null;

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

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): static
    {
        $this->number = $number;

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

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
