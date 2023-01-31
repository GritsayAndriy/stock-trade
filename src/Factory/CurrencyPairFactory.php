<?php

namespace App\Factory;

use App\Entity\CurrencyPair;
use App\Repository\CurrencyPairRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CurrencyPair>
 *
 * @method        CurrencyPair|Proxy create(array|callable $attributes = [])
 * @method static CurrencyPair|Proxy createOne(array $attributes = [])
 * @method static CurrencyPair|Proxy find(object|array|mixed $criteria)
 * @method static CurrencyPair|Proxy findOrCreate(array $attributes)
 * @method static CurrencyPair|Proxy first(string $sortedField = 'id')
 * @method static CurrencyPair|Proxy last(string $sortedField = 'id')
 * @method static CurrencyPair|Proxy random(array $attributes = [])
 * @method static CurrencyPair|Proxy randomOrCreate(array $attributes = [])
 * @method static CurrencyPairRepository|RepositoryProxy repository()
 * @method static CurrencyPair[]|Proxy[] all()
 * @method static CurrencyPair[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CurrencyPair[]|Proxy[] createSequence(array|callable $sequence)
 * @method static CurrencyPair[]|Proxy[] findBy(array $attributes)
 * @method static CurrencyPair[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CurrencyPair[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CurrencyPairFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->currencyCode() . '/' . self::faker()->currencyCode(),
            'firstCurrency' => CurrencyFactory::new(),
            'secondCurrency' => CurrencyFactory::new(),
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'updatedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
        ];
    }

    protected function initialize(): self
    {
        return $this// ->afterInstantiate(function(CurrencyPair $currencyPair): void {})
            ;
    }

    protected static function getClass(): string
    {
        return CurrencyPair::class;
    }
}
