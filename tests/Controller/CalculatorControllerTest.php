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
                '-55.19 * 2 + 66.11 / -2 - 77 + - 55.777 * 1 * 3 * -0.095 - 50',
                -254.538555
            ],
            [
                '55',
                55
            ],
            [
                '',
                0
            ],
            [
                '5*5',
                25
            ],
            [
                '1234567890-0987654321',
                246913569
            ],
            [
                '1000000 - 0.0000001',
                999999.9999999
            ],
            [
                '777.99 / 45 / -0.9 + 2 * 7.1',
                -5.009629629629632
            ],
            [
                '100 +-5',
                95
            ],
            [
                '-50 *2.05',
                -102.5
            ],
            [
                '80/-0.2',
                -400
            ]
        ];
    }
}
