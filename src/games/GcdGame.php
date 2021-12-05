<?php

namespace Brain\Games\Gcd;

use function Brain\Games\Engine\game;
use function Brain\Games\Helpers\calcGcd;

const MIN_RANDOM_VALUE = 0;
const MAX_RANDOM_VALUE = 100;

function run()
{
    game(
        'Find the greatest common divisor of given numbers.',
        function () {
            $random1 = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
            $random2 = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
            $result = calcGcd($random1, $random2);

            return [
                "$random1, $random2",
                $result
            ];
        }
    );
}
