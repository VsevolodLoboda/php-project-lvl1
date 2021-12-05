<?php

namespace Brain\Games\Prime;

use function Brain\Games\Helpers\boolToHumanAnswer;
use function Brain\Games\Engine\runBrainGame;
use function Brain\Games\Helpers\isPrime;

use const Brain\Games\Cli\FALSE_ANSWER;
use const Brain\Games\Cli\TRUE_ANSWER;

const GAME_DESCRIPTION = 'Answer "%s" if given number is prime. Otherwise answer "%s".';

const MIN_RANDOM_VALUE = 1;
const MAX_RANDOM_VALUE = 200;

/**
 * Run the game
 */
function run(): void
{
    $questionGenerator = function () {
        $randomValue = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);

        return [
            $randomValue,
            boolToHumanAnswer(isPrime($randomValue))
        ];
    };

    $gameDescription = vsprintf(GAME_DESCRIPTION, [
        TRUE_ANSWER,
        FALSE_ANSWER
    ]);

    runBrainGame($gameDescription, $questionGenerator);
}
