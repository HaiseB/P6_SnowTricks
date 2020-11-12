<?php


namespace App\Tests\Entity;

use App\Entity\Video;
use \PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    public function testSettingEmbedUrl()
    {
        $video = New Video();
        $formUrl = 'https://www.youtube.com/watch?v=Ix7zQdN4QWI';

        $video->setEmbedUrl($formUrl);

        $this->assertSame('Ix7zQdN4QWI', $video->getUrl());
    }
}