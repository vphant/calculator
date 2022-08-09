<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testCalculate(): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/calculate', ['inputValue' => '55']);
        $this->assertResponseIsSuccessful();

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(55, $responseData['result']);
    }
}
