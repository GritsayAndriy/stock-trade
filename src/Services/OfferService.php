<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Currency;
use App\Entity\CurrencyPair;
use App\Entity\Offer;
use App\Entity\WalletTransaction;
use App\Repository\CurrencyPairRepository;
use App\Repository\OfferRepository;
use App\Repository\WalletRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RequestStack;

class OfferService
{
    private WalletTransaction $reservedTransaction;
    private Offer $createdOffer;

    public function __construct(
        private RequestStack $requestStack,
        private Security $security,
        private CurrencyPairRepository $currencyPairRepository,
        private TransactionService $transactionService,
        private OfferRepository $offerRepository,
        private WithdrawFundsService $withdrawFundsService,
        private WalletRepository $walletRepository
    ) {
    }

    public function getReservedTransaction(): WalletTransaction
    {
        return $this->reservedTransaction;
    }

    public function getCreatedOffer(): Offer
    {
        return $this->createdOffer;
    }

    public function createOffer()
    {
        $request = $this->requestStack->getCurrentRequest();

        $amount = $request->get('amount');
        $price = $request->get('price');
        $currencyPair = $this->currencyPairRepository->find($request->get('currency_pair'));

        $currency = $this->getCurrencyByType($currencyPair, $request->get('type'));
        $wallet = $this->getUserWalletByCurrency($currency);

        $fundsAmount = $this->calculateFundsAmount($price, $amount);
        $this->withdrawFundsService->execute($wallet, $fundsAmount);

        $this->reservedTransaction = $this->transactionService->setWallet($wallet)
            ->createReserve($amount, WalletTransaction::TYPE_RESERVE);

        $offer = new Offer();
        $offer->setUser($this->security->getUser());
        $offer->setWalletTransaction($this->reservedTransaction);
        $offer->setAmount((int)$amount);
        $offer->setCurrencyPair($currencyPair);
        $offer->setPrice($price);
        $offer->setType($request->get('type'));
        $offer->setCurrentAmount(0);
        $this->offerRepository->save($offer);
        $this->createdOffer = $offer;
        return $this;
    }

    public function canceleOffer(Offer $offer)
    {

    }

    private function getCurrencyByType(CurrencyPair $currencyPair, string $type)
    {
        if ($type == Offer::TYPE_BUY) {
            $currency = $currencyPair->getSecondCurrency();
        } elseif ($type == Offer::TYPE_SELL) {
            $currency = $currencyPair->getFirstCurrency();
        } else {
            throw new \Exception('Not valid type');
        }

        return $currency;
    }

    private function getUserWalletByCurrency(Currency $currency)
    {
        $wallets = $this->walletRepository->findBy([
            'user' => $this->security->getUser(),
            'currency' => $currency
        ]);
        if (empty($wallets)) {
            throw new \Exception('Not found wallet');
        }

        return $wallets[0];
    }

    private function calculateFundsAmount(string $price, string $amount)
    {
        return bcmul($price, $amount);
    }
}