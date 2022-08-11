<?php

namespace App\Tests\Service;

use App\Service\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculatorServiceTest extends KernelTestCase
{
    /**
     * @dataProvider getSuccessCases
     */
    public function testCalculateResult($inputValue, $expectedResult): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /* @var CalculatorService $calculator */
        $calculator = $container->get(CalculatorService::class);
        $result = $calculator->calculateResult($inputValue);
        $this->assertEquals($expectedResult, $result);
    }

    public function getSuccessCases()
    {
        return [
            [
                '-99 * 7 + 2 * -5 * -5 /555 -0.04 + 0.07',
                -692.8799099099098
            ],
            [
                '199',
                199
            ],
            [
                '  ',
                0
            ],
            [
                '-9*-8',
                72
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
                '355 * 6 / 2 +-9',
                1056
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
