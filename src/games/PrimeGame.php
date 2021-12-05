<?php

namespace Brain\Games\Prime;

use function Brain\Games\Engine\game;
use function Brain\Games\Helpers\isPrime;

const MIN_RANDOM_VALUE = 1;
const MAX_RANDOM_VALUE = 200;

const TRUE_ANSWER = 'yes';
const FALSE_ANSWER = 'no';

function run()
{
    game(
        'Answer "yes" if given number is prime. Otherwise answer "no".',
        function () {
            $randomValue = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);

            return [
                (string)$randomValue,
                (isPrime($randomValue) ? TRUE_ANSWER : FALSE_ANSWER)
            ];
        }
    );
}
