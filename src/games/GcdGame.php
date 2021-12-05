<?php

namespace Brain\Games\Gcd;

use function Brain\Games\Engine\runBrainGame;
use function Brain\Games\Helpers\calcGcd;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';

const MIN_RANDOM_VALUE = 0;
const MAX_RANDOM_VALUE = 100;

/**
 * Run the game
 */
function run(): void
{
    $questionGenerator = function () {
        $random1 = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
        $random2 = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
        $result = calcGcd($random1, $random2);

        return [
            "$random1, $random2",
            $result
        ];
    };

    runBrainGame(GAME_DESCRIPTION, $questionGenerator);
}
