<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    public function testCreateBook()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/submit',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title:""}'
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testCreateBookEmptyData()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/submit',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            ''
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testCreateBookSuccess()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/submit',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title:"El imperio final"}'
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
