<?php

namespace Tests;

use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    public function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    public function testSumMethod()
    {
        $sum = $this->calculator->sum(1, 2);

        $this->assertEquals(3, $sum);
    }

    public function testSumMethodWithNegativeNumbers()
    {
        $sum = $this->calculator->sum(-11, -20);

        $this->assertEquals(-31, $sum);
    }

    public function testAverageMethod()
    {
        $average = $this->calculator->average([1, 2, 3]);

        $this->assertEquals(2, $average);
    }

    public function testAverageMethodWithEmptyList()
    {
        $average = $this->calculator->average([]);

        $this->assertEquals(0, $average);
    }
}