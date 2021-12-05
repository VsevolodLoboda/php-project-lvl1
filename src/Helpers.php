<?php

namespace Brain\Games\Helpers;

use function Brain\Games\Cli\printLine;

use const Brain\Games\Cli\FALSE_ANSWER;
use const Brain\Games\Cli\TRUE_ANSWER;

/**
 * Determines if the number is even
 *
 * @param int $number Verifiable number
 * @return bool
 */
function isEven(int $number): bool
{
    return $number % 2 === 0;
}

/**
 * Determines if the number is prime
 *
 * @param int $number Verifiable number
 * @return bool
 */
function isPrime(int $number): bool
{
    for ($x = 2; $x < $number; $x += 1) {
        if ($number % $x == 0) {
            return false;
        }
    }
    return true;
}

/**
 * Determines the greatest common divisor of two numbers
 *
 * @param int $val1
 * @param int $val2
 * @return int gcd
 */
function calcGcd(int $val1, int $val2): int
{
    if ($val2 === 0) {
        return $val1;
    }

    return calcGcd($val2, $val1 % $val2);
}

/**
 * Generates an arithmetic progression of a given length
 *
 * @param int $lowRange Lower threshold for generating values in the progression
 * @param int $topRange Top threshold for generating values in the progression
 * @param int $length Number of values in the progression
 * @return array Progression
 */
function genAProgression(int $lowRange = 1, int $topRange = 1000, int $length = 10): array
{
    $step = mt_rand($lowRange, round($topRange / $length));
    if ($step < $lowRange) {
        $step = $lowRange;
    }

    $range = range($lowRange, $topRange, $step);
    if (!$range) {
        criticalError(
            'Incorrect parameters for progression generation: ' .
            "low=$lowRange;top=$topRange;length=$length"
        );
    }

    $spliceOffset = mt_rand(0, count($range) - $length);

    return array_splice($range, $spliceOffset, $length);
}

/**
 * Converts the boolean representation of the answer to a string
 *
 * @param bool $answer Answer in boolean representation
 * @return string Human representation
 */
function boolToHumanAnswer(bool $answer): string
{
    return $answer ? TRUE_ANSWER : FALSE_ANSWER;
}

/**
 * Replace placeholder in text with TRUE_ANSWER and FALSE_ANSWER constant
 *
 * @param string $text Test with placeholders
 * @return string
 */
function replaceAnswersPlaceholder(string $text): string
{
    return vsprintf($text, [
        TRUE_ANSWER,
        FALSE_ANSWER
    ]);
}

/**
 * Stops the program and displays an error
 *
 * @param string $message Error message
 * @param int $exitCode Exit code
 */
function criticalError(string $message, int $exitCode = 1): void
{
    // I'm using this solution instead of exception, since students don't know about it at this point
    printLine($message);
    exit($exitCode);
}
