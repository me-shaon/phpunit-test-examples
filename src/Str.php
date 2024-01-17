<?php

namespace App;

class Str
{
    // 'Hello!' => 'Hello'
    // 'Hello!' => 'Hello'
    // 'Hello world      ' => 'Hello world'
    // '       ' => ''
    public function trim(string $str, array $chars=[' '])
    {
        $startIndex = 0;
        $endIndex = strlen($str) - 1;

        $currentIndex = $startIndex;
        while($currentIndex <= $endIndex) {
            if (in_array($str[$currentIndex], $chars)) {
                $currentIndex++;
            } else {
                break;
            }
        }
        $startIndex = $currentIndex;

        $currentIndex = $endIndex;
        while($currentIndex >= $startIndex) {
            if (in_array($str[$currentIndex], $chars)) {
                $currentIndex--;
            } else {
                break;
            }
        }
        $endIndex = $currentIndex;

        $result = "";
        for($i=$startIndex;$i<=$endIndex;$i++) {
            $result .= $str[$i];
        }

        return $result;
    }
}