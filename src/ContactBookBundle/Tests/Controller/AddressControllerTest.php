<?php

namespace ContactBookBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddressControllerTest extends WebTestCase
{
    public function testNewaddress()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newAddress');
    }

    public function testEditaddress()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editAddress');
    }

    public function testDeleteaddress()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteAddress');
    }

}
