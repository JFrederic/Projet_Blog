<?php

namespace LeBonZafer\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentaireControllerTest extends WebTestCase
{
    public function testAddcomment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}/comment');
    }

}
