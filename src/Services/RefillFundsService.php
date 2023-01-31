<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Wallet;

class RefillFundsService
{
    public function execute(Wallet $wallet, string $refillAmount)
    {
        $newWalletAmount = bcadd($wallet->getAmount(), $refillAmount);
        $wallet->setAmount($newWalletAmount);
        return $wallet;
    }
}