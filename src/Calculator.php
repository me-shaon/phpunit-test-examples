<?php

namespace App;

class Calculator
{
    public function sum(int $a, int $b): int
    {
        return $a + $b;
    }

    public function average(array $items): float
    {
        $totalItems = count($items);

        if ($totalItems === 0) {
            return 0;
        }

        $sum = 0;

        foreach ($items as $item) {
            $sum += $item;
        }

        return $sum / $totalItems;
    }
}