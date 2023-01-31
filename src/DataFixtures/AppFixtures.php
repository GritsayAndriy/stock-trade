<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Factory\CurrencyFactory;
use App\Factory\UserFactory;
use App\Factory\WalletFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $users = UserFactory::createMany(3);
        $currencyUsd = CurrencyFactory::find([
            'name' => 'USD',
        ]);
        $currencyBtc = CurrencyFactory::find([
            'name' => 'BTC',
        ]);
        $currencyEth = CurrencyFactory::find([
            'name' => 'ETH',
        ]);

        foreach ($users as $user) {
            WalletFactory::createOne([
                'user' => $user,
                'currency' => $currencyUsd
            ]);
            WalletFactory::createOne([
                'user' => $user,
                'currency' => $currencyBtc
            ]);
            WalletFactory::createOne([
                'user' => $user,
                'currency' => $currencyEth
            ]);
        }
    }

    public function getDependencies()
    {
        return [
            CurrencyFixtures::class,
            CurrencyPairFixtures::class,
            AdminUserFixtures::class
        ];
    }
}
