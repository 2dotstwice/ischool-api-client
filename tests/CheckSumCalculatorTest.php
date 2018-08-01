<?php

namespace TwoDotsTwice\ISchoolApiClient;

use PHPUnit\Framework\TestCase;

class CheckSumCalculatorTest extends TestCase
{
    /**
     * @var \TwoDotsTwice\ISchoolApiClient\CheckSumCalculator
     */
    private $checkSumCalculator;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->checkSumCalculator = new CheckSumCalculator('AZERTY');
    }

    public function testCheckSum()
    {
        $checkSum = $this->checkSumCalculator->checkSum(
            'PLUGIN',
            279,
            'ACTIVITIES_JSON'
        );

        $this->assertSame('AD4D2861DC4B400768CCB35DDCB2E904', $checkSum);
    }
}
