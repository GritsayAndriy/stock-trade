<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\WalletRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WalletRepository::class)]
#[ORM\Table(name: '`wallets`')]
class Wallet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $amount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'wallets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'wallets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Currency $currency = null;

    #[ORM\OneToMany(mappedBy: 'wallet', targetEntity: WalletTransaction::class)]
    private Collection $walletTransactions;

    public function __construct()
    {
        $this->walletTransactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

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

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(?Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return Collection<int, WalletTransaction>
     */
    public function getWalletTransactions(): Collection
    {
        return $this->walletTransactions;
    }

    public function addWalletTransaction(WalletTransaction $walletTransaction): self
    {
        if (!$this->walletTransactions->contains($walletTransaction)) {
            $this->walletTransactions->add($walletTransaction);
            $walletTransaction->setWallet($this);
        }

        return $this;
    }

    public function removeWalletTransaction(WalletTransaction $walletTransaction): self
    {
        if ($this->walletTransactions->removeElement($walletTransaction)) {
            // set the owning side to null (unless already changed)
            if ($walletTransaction->getWallet() === $this) {
                $walletTransaction->setWallet(null);
            }
        }

        return $this;
    }
}
