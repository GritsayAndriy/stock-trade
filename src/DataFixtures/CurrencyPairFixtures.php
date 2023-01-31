<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Factory\CurrencyFactory;
use App\Factory\CurrencyPairFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CurrencyPairFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $currencyUsd = CurrencyFactory::find([
                'name' => 'USD'
            ]
        );
        $currencyBtc = CurrencyFactory::find([
                'name' => 'BTC'
            ]
        );
        $currencyEth = CurrencyFactory::find([
                'name' => 'ETH'
            ]
        );

        CurrencyPairFactory::createOne([
            'name' => 'BTC/USD',
            'firstCurrency' => $currencyBtc,
            'secondCurrency' => $currencyUsd
        ]);

        CurrencyPairFactory::createOne([
            'name' => 'USD/BTC',
            'firstCurrency' => $currencyUsd,
            'secondCurrency' => $currencyBtc
        ]);
        CurrencyPairFactory::createOne([
            'name' => 'ETH/USD',
            'firstCurrency' => $currencyEth,
            'secondCurrency' => $currencyUsd
        ]);
        CurrencyPairFactory::createOne([
            'name' => 'USD/ETH',
            'firstCurrency' => $currencyUsd,
            'secondCurrency' => $currencyEth
        ]);
    }
}
