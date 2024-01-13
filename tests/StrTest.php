<?php

namespace Tests;

use App\Str;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class StrTest extends TestCase
{
    public static function provideTrimData(): array
    {
        return [
            "nothing to trim" =>
                ["Hello world!", "Hello world!"],
            "leading and trailing spaces are trimmed" =>
                ["Hello world!", " Hello world!     "],
            "other characters can be trimmed" =>
                ["Hello world", " Hello world!", [" ", "!"]],
            "trim to empty string if all are spaces" =>
                ["", "        "],
            "trim to empty string if there is nothing else left" =>
                ["", "AAAAAA", ["A"]],
        ];
    }

    #[DataProvider('provideTrimData')]
    public function testTrimMethod($expected, $input, $chars=[" "])
    {
        $str = new Str();

        $result = $str->trim($input, $chars);

        $this->assertEquals($expected, $result);
    }
}