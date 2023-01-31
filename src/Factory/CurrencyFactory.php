<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Currency>
 *
 * @method        Currency|Proxy create(array|callable $attributes = [])
 * @method static Currency|Proxy createOne(array $attributes = [])
 * @method static Currency|Proxy find(object|array|mixed $criteria)
 * @method static Currency|Proxy findOrCreate(array $attributes)
 * @method static Currency|Proxy first(string $sortedField = 'id')
 * @method static Currency|Proxy last(string $sortedField = 'id')
 * @method static Currency|Proxy random(array $attributes = [])
 * @method static Currency|Proxy randomOrCreate(array $attributes = [])
 * @method static CurrencyRepository|RepositoryProxy repository()
 * @method static Currency[]|Proxy[] all()
 * @method static Currency[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Currency[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Currency[]|Proxy[] findBy(array $attributes)
 * @method static Currency[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Currency[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CurrencyFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'code' => self::faker()->currencyCode(),
            'name' => self::faker()->currencyCode(),
        ];
    }

    protected function initialize(): self
    {
        return $this
             ->afterInstantiate(function(Currency $currency): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Currency::class;
    }
}
