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
            ["Hello world!", "Hello world!"],
            ["Hello world!", " Hello world!     "],
            ["Hello world", " Hello world!", [" ", "!"]],
            ["", "        "],
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