<?php

namespace App\Factory;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Video|Proxy findOrCreate(array $attributes)
 * @method static Video|Proxy random()
 * @method static Video[]|Proxy[] randomSet(int $number)
 * @method static Video[]|Proxy[] randomRange(int $min, int $max)
 * @method static VideoRepository|RepositoryProxy repository()
 * @method Video|Proxy create($attributes = [])
 * @method Video[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class VideoFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        $faker = \Faker\Factory::create("fr_FR");

        return [
            'url' => $faker->lexify('???????????'),
            'isDeleted' => rand(0, 9) < 8 ? 1  : 0,
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(Video $video) {})
        ;
    }

    protected static function getClass(): string
    {
        return Video::class;
    }
}
