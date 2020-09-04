<?php

namespace App\Factory;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Trick|Proxy findOrCreate(array $attributes)
 * @method static Trick|Proxy random()
 * @method static Trick[]|Proxy[] randomSet(int $number)
 * @method static Trick[]|Proxy[] randomRange(int $min, int $max)
 * @method static TrickRepository|RepositoryProxy repository()
 * @method Trick|Proxy create($attributes = [])
 * @method Trick[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class TrickFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        $faker = \Faker\Factory::create("fr_FR");

        return [
            'name' => $faker->sentence(2),
            'content' => $faker->text(),
            'isOnline' => (rand(0, 1)),
            'isDeleted' => rand(0, 9) > 8 ? 1  : 0,
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(Trick $trick) {})
        ;
    }

    protected static function getClass(): string
    {
        return Trick::class;
    }
}
