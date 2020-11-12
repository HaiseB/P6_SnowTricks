<?php


namespace App\Tests\Entity;

use App\Entity\Picture;
use App\Entity\Trick;
use \PHPUnit\Framework\TestCase;

class PictureTest extends TestCase
{
    public function testCreatingDefaultMainPicture()
    {
        $picture = New Picture();
        $trick = new Trick();

        $picture->createDefaultMainPicture($trick);

        $this->assertSame('defaultMain.jpg', $picture->getPath());
        $this->assertTrue($picture->getIsMain());
        $this->assertSame('Vue sur une montage enneigée', $picture->getLegend());
        $this->assertSame($trick, $picture->getTrick());
    }
}