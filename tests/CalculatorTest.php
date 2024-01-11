<?php

namespace Tests;

use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testSumMethod()
    {
        $calculator = new Calculator();

        $sum = $calculator->sum(1, 2);

        $this->assertEquals(3, $sum);
    }

    public function testSumMethodWithNegativeNumbers()
    {
        $calculator = new Calculator();

        $sum = $calculator->sum(-11, -20);

        $this->assertEquals(-31, $sum);
    }

    public function testAverageMethod()
    {
        $calculator = new Calculator();

        $average = $calculator->average([1, 2, 3]);

        $this->assertEquals(2, $average);
    }

    public function testAverageMethodWithEmptyList()
    {
        $calculator = new Calculator();

        $average = $calculator->average([]);

        $this->assertEquals(0, $average);
    }
}