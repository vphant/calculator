<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    /**
     * @dataProvider getSuccessCases
     */
    public function testCalculate($inputValue, $expectedResult): void
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/calculate', ['inputValue' => $inputValue]);
        $this->assertResponseIsSuccessful();

        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals($expectedResult, $responseData['result']);
    }

    public function getSuccessCases()
    {
        return [
            [
                '55',
                55
            ],
            [
                '',
                0
            ],
            [
                '-55.19 * 2 + 66.11 / -2 - 77 + - 55.777 * 1 * 3 * -0.095 - 50',
                -254.538555
            ]
        ];
    }
}
