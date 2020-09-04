<?php

namespace App\Factory;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Tag|Proxy findOrCreate(array $attributes)
 * @method static Tag|Proxy random()
 * @method static Tag[]|Proxy[] randomSet(int $number)
 * @method static Tag[]|Proxy[] randomRange(int $min, int $max)
 * @method static TagRepository|RepositoryProxy repository()
 * @method Tag|Proxy create($attributes = [])
 * @method Tag[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class TagFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        $faker = \Faker\Factory::create("fr_FR");

        return [
            'name' => $faker->word(10),
            'isDeleted' => rand(0, 9) > 8 ? 1  : 0,
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(Tag $tag) {})
        ;
    }

    protected static function getClass(): string
    {
        return Tag::class;
    }
}
