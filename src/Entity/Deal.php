<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\DealRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DealRepository::class)]
#[ORM\Table(name: '`deals`')]
class Deal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sellDeals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offer $sellOffer = null;

    #[ORM\ManyToOne(inversedBy: 'buyDeals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offer $buyOffer = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSellOffer(): ?Offer
    {
        return $this->sellOffer;
    }

    public function setSellOffer(?Offer $sellOffer): self
    {
        $this->sellOffer = $sellOffer;

        return $this;
    }

    public function getBuyOffer(): ?Offer
    {
        return $this->buyOffer;
    }

    public function setBuyOffer(?Offer $buyOffer): self
    {
        $this->buyOffer = $buyOffer;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
