<?php

namespace App\DataFixtures;

use App\Factory\CommentFactory;
use App\Factory\PictureFactory;
use App\Factory\TagFactory;
use App\Factory\TrickFactory;
use App\Factory\UserFactory;
use App\Factory\VideoFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        TagFactory::new()->createMany(20);
        UserFactory::new()->createMany(15);

        TrickFactory::new()->createMany(50, function() {
            return [
                'tag' => TagFactory::random(),
                'user' => UserFactory::random(),
            ];
        });

        CommentFactory::new()->createMany(200, function() {
            return [
                'user' => UserFactory::random(),
                'trick' => TrickFactory::random(),
            ];
        });

        PictureFactory::new()->createMany(200, function() {
            return [
                'trick' => TrickFactory::random(),
            ];
        });

        VideoFactory::new()->createMany(200, function() {
            return [
                'trick' => TrickFactory::random(),
            ];
        });

        $manager->flush();
    }
}
