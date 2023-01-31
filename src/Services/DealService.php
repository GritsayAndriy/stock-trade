<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Offer;
use Symfony\Bundle\SecurityBundle\Security;

class DealService
{
    public function __construct(
        private Security $security,
    )
    {
    }

    public function executeDeal(Offer $offer)
    {
        $userOffer = new Offer();
        $userOffer->setUser($this->security->getUser());
        $userOffer->setCurrencyPair($offer->getCurrencyPair());
        $userOffer->setAmount($offer->getAmount());
        $userOffer->setType($this->getType($offer->getType()));
        $userOffer->setPrice($offer->getPrice());
        $userOffer->setStatus(Offer::STATUS_CLOSED);
    }
    private function getType(string $type): string
    {
        return $type == Offer::TYPE_BUY ? Offer::TYPE_SELL : Offer::TYPE_BUY;
    }
}