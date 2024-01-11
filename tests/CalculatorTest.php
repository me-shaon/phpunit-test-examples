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
}