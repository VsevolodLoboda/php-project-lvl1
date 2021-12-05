<?php

namespace Brain\Games\Even;

use function Brain\Games\Helpers\isEven;
use function Brain\Games\Engine\runBrainGame;
use function Brain\Games\Helpers\boolToHumanAnswer;

use const Brain\Games\Cli\FALSE_ANSWER;
use const Brain\Games\Cli\TRUE_ANSWER;

const GAME_DESCRIPTION = 'Answer "%s" if the number is even, otherwise answer "%s".';

const MIN_RANDOM_VALUE = 0;
const MAX_RANDOM_VALUE = 100;

/**
 * Run the game
 */
function run(): void
{
    $questionGenerator = function () {
        $randomValue = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);

        return [
            $randomValue,
            boolToHumanAnswer(isEven($randomValue))
        ];
    };

    $gameDescription = vsprintf(GAME_DESCRIPTION, [
        TRUE_ANSWER,
        FALSE_ANSWER
    ]);

    runBrainGame($gameDescription, $questionGenerator);
}
