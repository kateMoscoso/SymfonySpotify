<?php

namespace MiwSpotifyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArtistaControllerTest extends WebTestCase
{
    public function testBuscarartista()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/buscarArtista');
    }

}
