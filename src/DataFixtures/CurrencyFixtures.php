<?php

namespace App\DataFixtures;

use App\Factory\CurrencyFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CurrencyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CurrencyFactory::findOrCreate([
            'name' => 'USD',
            'code' => 'USD'
        ]);
        CurrencyFactory::findOrCreate([
            'name' => 'BTC',
            'code' => 'BTC'
        ]);
        CurrencyFactory::findOrCreate([
            'name' => 'ETH',
            'code' => 'ETH'
        ]);
    }
}
