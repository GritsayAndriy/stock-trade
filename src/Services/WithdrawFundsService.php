<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Wallet;
use App\Repository\WalletRepository;

class WithdrawFundsService
{
    public function __construct(private WalletRepository $walletRepository)
    {
    }

    public function execute(Wallet $wallet, string $withdrawalAmount)
    {
        if (bccomp($wallet->getAmount(), $withdrawalAmount) >= 0) {
            $newWalletAmount = bcsub($wallet->getAmount(), $withdrawalAmount);
        } else {
            throw new \Exception('There are few funds');
        }
        $wallet->setAmount($newWalletAmount);
        $this->walletRepository->save($wallet);
    }
}