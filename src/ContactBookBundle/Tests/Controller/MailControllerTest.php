<?php

namespace ContactBookBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MailControllerTest extends WebTestCase
{
    public function testNewmail()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newMail');
    }

    public function testEditmail()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editMail');
    }

    public function testDeletemail()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteMail');
    }

}
