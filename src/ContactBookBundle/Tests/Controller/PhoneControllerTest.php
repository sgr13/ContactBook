<?php

namespace ContactBookBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PhoneControllerTest extends WebTestCase
{
    public function testNewphone()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newPhone');
    }

    public function testEditphone()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editPhone');
    }

    public function testDeletephone()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deletePhone');
    }

}
