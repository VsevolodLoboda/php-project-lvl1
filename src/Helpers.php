<?php

namespace BrainGames\Helpers;

use function BrainGames\Cli\printLine;

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
