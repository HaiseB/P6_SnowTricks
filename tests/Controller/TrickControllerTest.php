<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TrickControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testGetTricksWithAjax()
    {
        $client = static::createClient();
        $client->xmlHttpRequest('GET', '/getTricks/0');

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testCreateTrickWithoutBeingLogged()
    {
        $client = static::createClient();
        $client->request('GET', '/trick/new');

        $this->assertResponseRedirects('/login');
    }

    public function testShowTrickWhileUnlogged()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/trick/mute');
        $loginButton = $crawler->selectLink('Se connecter')->count();

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSame(1, $loginButton);
    }

}