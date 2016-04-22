<?php

namespace GrossumTestTaskBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrControllerTest extends WebTestCase
{
    public function testRegistr()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/registr');
    }

}
