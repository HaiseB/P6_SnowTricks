<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use App\Entity\Trick;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create("fr_FR");

        for ($i = 0; $i < 10; $i++) {
            $tag = new Tag();
            $timestamp = $faker->dateTimeBetween('-1 year', 'now');

            $tag
                ->setName($faker->word(10))
                ->setCreatedAt($timestamp)
                ->setUpdatedAt($timestamp)
                ->setIsDeleted(rand(0, 1));

            $manager->persist($tag);
        }

        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $timestamp = $faker->dateTimeBetween('-1 year', 'now');
            $password = $this->encoder->encodePassword($user, 'password');

            $user
                ->setUsername($faker->username)
                ->setPassword($password)
                ->setEmail($faker->email)
                ->setToken('')
                ->setIsRegistered(rand(0, 1))
                ->setCreatedAt($timestamp)
                ->setUpdatedAt($timestamp)
                ->setIsDeleted(rand(0, 1));

            $manager->persist($user);
        }

        /*for ($i = 0; $i < 40; $i++) {
            $trick = new Trick();
            $timestamp = $faker->dateTimeBetween('-1 year', 'now');

            $trick
                ->setUserId()
                ->setName($faker->sentence(2))
                ->setContent($faker->text())
                ->setUserId('1')
                ->setIsOnline(rand(0, 1))
                ->setCreatedAt($timestamp)
                ->setUpdatedAt($timestamp)
                ->setIsDeleted(rand(0, 1));

            $manager->persist($trick);
        }*/

        $manager->flush();
    }
}
