<?php

namespace App\Factory;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Comment|Proxy findOrCreate(array $attributes)
 * @method static Comment|Proxy random()
 * @method static Comment[]|Proxy[] randomSet(int $number)
 * @method static Comment[]|Proxy[] randomRange(int $min, int $max)
 * @method static CommentRepository|RepositoryProxy repository()
 * @method Comment|Proxy create($attributes = [])
 * @method Comment[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class CommentFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        $faker = \Faker\Factory::create("fr_FR");

        return [
            'content' => $faker->sentence(20),
            'isDeleted' => rand(0, 9) > 8 ? 1  : 0,
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(Comment $comment) {})
        ;
    }

    protected static function getClass(): string
    {
        return Comment::class;
    }
}
