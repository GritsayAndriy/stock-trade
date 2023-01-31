<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Wallet;
use App\Entity\WalletTransaction;
use App\Repository\WalletRepository;
use App\Repository\WalletTransactionRepository;
use Symfony\Bundle\SecurityBundle\Security;

class TransactionService
{
    private Wallet $wallet;

    public function __construct(
        private WalletTransactionRepository $walletTransactionRepository,
    ) {
    }

    public function setWallet(Wallet $wallet)
    {
        $this->wallet = $wallet;
        return $this;
    }

    public function createReserve($amount, $type)
    {
        return $this->create($amount, $type, WalletTransaction::STATUS_RESERVED);
    }

    private function create($amount, $type, $status)
    {
        $transaction = new WalletTransaction();
        $transaction->setWallet($this->wallet);
        $transaction->setAmount((string)$amount);
        $transaction->setType($type);
        $transaction->setStatus($status);
        $this->walletTransactionRepository->save($transaction);
        return $transaction;
    }
}