<?php

declare(strict_types=1);

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
