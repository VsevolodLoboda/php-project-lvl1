<?php

namespace Brain\Games\Cli;

use function cli\line;
use function cli\prompt;

/**
 * Show greetings, in command line, returns name of user
 *
 * @return string
 */
function runGreetings(): string
{
    line('Welcome to the Brain Game!');
    $name = trim(prompt('May I have your name?'));
    line("Hello, %s!", $name);

    return $name;
}

function printLine(string $line): void
{
    line($line);
}

function promt(string $message): string
{
    return prompt($message);
}
