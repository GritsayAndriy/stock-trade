<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
#[ORM\Table(name: '`offers`')]
class Offer
{
    const STATUS_PENDING = 'pending';
    const STATUS_CANCEL = 'cancel';
    const STATUS_CLOSED = 'closed';

    const TYPE_BUY = 'buy';
    const TYPE_SELL = 'sell';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $currentAmount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'sellOffer', targetEntity: Deal::class)]
    private Collection $sellDeals;

    #[ORM\OneToMany(mappedBy: 'buyOffer', targetEntity: Deal::class)]
    private Collection $buyDeals;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CurrencyPair $currencyPair = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WalletTransaction $walletTransaction = null;

    public function __construct()
    {
        $this->sellDeals = new ArrayCollection();
        $this->buyDeals = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->status = self::STATUS_PENDING;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCurrentAmount(): ?int
    {
        return $this->currentAmount;
    }

    public function setCurrentAmount(int $currentAmount): self
    {
        $this->currentAmount = $currentAmount;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Deal>
     */
    public function getSellDeals(): Collection
    {
        return $this->sellDeals;
    }

    public function addSellDeal(Deal $sellDeal): self
    {
        if (!$this->sellDeals->contains($sellDeal)) {
            $this->sellDeals->add($sellDeal);
            $sellDeal->setSellOffer($this);
        }

        return $this;
    }

    public function removeSellDeal(Deal $sellDeal): self
    {
        if ($this->sellDeals->removeElement($sellDeal)) {
            // set the owning side to null (unless already changed)
            if ($sellDeal->getSellOffer() === $this) {
                $sellDeal->setSellOffer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Deal>
     */
    public function getBuyDeals(): Collection
    {
        return $this->buyDeals;
    }

    public function addBuyDeal(Deal $buyDeal): self
    {
        if (!$this->buyDeals->contains($buyDeal)) {
            $this->buyDeals->add($buyDeal);
            $buyDeal->setBuyOffer($this);
        }

        return $this;
    }

    public function removeBuyDeal(Deal $buyDeal): self
    {
        if ($this->buyDeals->removeElement($buyDeal)) {
            // set the owning side to null (unless already changed)
            if ($buyDeal->getBuyOffer() === $this) {
                $buyDeal->setBuyOffer(null);
            }
        }

        return $this;
    }

    public function getCurrencyPair(): ?CurrencyPair
    {
        return $this->currencyPair;
    }

    public function setCurrencyPair(?CurrencyPair $currencyPair): self
    {
        $this->currencyPair = $currencyPair;

        return $this;
    }

    public function getWalletTransaction(): ?WalletTransaction
    {
        return $this->walletTransaction;
    }

    public function setWalletTransaction(?WalletTransaction $walletTransaction): self
    {
        $this->walletTransaction = $walletTransaction;

        return $this;
    }
}
