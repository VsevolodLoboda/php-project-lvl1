<?php

namespace Brain\Games\Helpers;

function isEven(int $number): bool
{
    return $number % 2 === 0;
}

function isPrime(int $number): bool
{
    for ($x = 2; $x < $number; $x += 1) {
        if ($number % $x == 0) {
            return false;
        }
    }
    return true;
}

function calcGcd($val1, $val2)
{
    if ($val2 === 0) {
        return $val1;
    }

    return calcGcd($val2, $val1 % $val2);
}

function genAProgression(int $lowRange = 1, int $topRange = 1000, int $length = 10): array
{
    $step = mt_rand($lowRange, round($topRange / $length));
    if ($step < $lowRange) {
        $step = $lowRange;
    }

    $range = range($lowRange, $topRange, $step);
    $spliceOffset = mt_rand(0, count($range) - $length);

    return array_splice($range, $spliceOffset, $length);
}
