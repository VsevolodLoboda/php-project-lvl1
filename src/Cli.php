<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

/**
 * Show greetings in command line
 */
function startGreetingsDialog(): void
{
    line('Welcome to the Brain Games!');
    $name = trim(prompt('May I have your name?'));
    line("Hello, %s!", $name);
}

/**
 * Request to enter an answer to a question
 *
 * @param string $introductoryText entry prompt text
 * @return string Text entered by the user
 */
function readInput(string $introductoryText): string
{
    return prompt($introductoryText);
}

/**
 * Outputs a line on the terminal
 *
 * @param string $line The string that will be displayed in the console
 */
function printLine(string $line): void
{
    line($line);
}
