<?php

namespace App\DataFixtures;

use App\Factory\WalletFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        WalletFactory::createMany(3);
    }
}
