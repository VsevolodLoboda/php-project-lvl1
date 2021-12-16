<?php

namespace Brain\Games\Gcd;

use function Brain\Games\Engine\runBrainGame;

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

        $question = "$random1 $random2";
        $answer = (string)calcGcd($random1, $random2);

        return [
            $question,
            $answer
        ];
    };

    runBrainGame(GAME_DESCRIPTION, $questionGenerator);
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
