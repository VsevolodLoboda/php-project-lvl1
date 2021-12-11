<?php

namespace Brain\Games\Helpers;

use function Brain\Games\Cli\printLine;

use const Brain\Games\Cli\FALSE_ANSWER;
use const Brain\Games\Cli\TRUE_ANSWER;

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
