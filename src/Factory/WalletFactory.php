<?php

namespace App\Factory;

use App\Entity\Wallet;
use App\Repository\WalletRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Wallet>
 *
 * @method        Wallet|Proxy create(array|callable $attributes = [])
 * @method static Wallet|Proxy createOne(array $attributes = [])
 * @method static Wallet|Proxy find(object|array|mixed $criteria)
 * @method static Wallet|Proxy findOrCreate(array $attributes)
 * @method static Wallet|Proxy first(string $sortedField = 'id')
 * @method static Wallet|Proxy last(string $sortedField = 'id')
 * @method static Wallet|Proxy random(array $attributes = [])
 * @method static Wallet|Proxy randomOrCreate(array $attributes = [])
 * @method static WalletRepository|RepositoryProxy repository()
 * @method static Wallet[]|Proxy[] all()
 * @method static Wallet[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Wallet[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Wallet[]|Proxy[] findBy(array $attributes)
 * @method static Wallet[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Wallet[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class WalletFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $currency = CurrencyFactory::findOrCreate([
            'name' => 'USD',
            'code' => 'USD'
        ]);

        return [
            'amount' => self::faker()->randomFloat(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'currency' => $currency,
            'updatedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'user' => UserFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Wallet $wallet): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Wallet::class;
    }
}
