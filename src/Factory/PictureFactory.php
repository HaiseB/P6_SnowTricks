<?php

namespace App\Factory;

use App\Entity\Picture;
use App\Repository\PictureRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Picture|Proxy findOrCreate(array $attributes)
 * @method static Picture|Proxy random()
 * @method static Picture[]|Proxy[] randomSet(int $number)
 * @method static Picture[]|Proxy[] randomRange(int $min, int $max)
 * @method static PictureRepository|RepositoryProxy repository()
 * @method Picture|Proxy create($attributes = [])
 * @method Picture[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class PictureFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        $faker = \Faker\Factory::create("fr_FR");

        return [
            'path' => '',
            'legend' =>  $faker->sentence(4),
            'isMain' => (rand(0, 1)),
            'isDeleted' => rand(0, 9) < 8 ? 1  : 0,
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(Picture $picture) {})
        ;
    }

    protected static function getClass(): string
    {
        return Picture::class;
    }
}
