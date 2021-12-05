<?php

namespace Brain\Games\Cli;

use function cli\line;
use function cli\prompt;

const TRUE_ANSWER = 'yes'; // Positive response to closed questions
const FALSE_ANSWER = 'no'; // Negative response to closed questions

/**
 * Show greetings, in command line, returns name of user
 *
 * @return string User name
 */
function startGreetingsDialog(): string
{
    line('Welcome to the Brain Game!');
    $name = trim(prompt('May I have your name?'));
    line("Hello, %s!", $name);

    return $name;
}

/**
 * Print question for user
 *
 * @param string $question Question content
 */
function printQuestion(string $question): void
{
    line("Question: $question");
}

/**
 * Request to enter an answer to a question
 *
 * @return string Text entered by the user
 */
function askUserAnswer(): string
{
    return trim(prompt('Your answer'));
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
