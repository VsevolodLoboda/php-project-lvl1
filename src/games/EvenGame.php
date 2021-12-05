<?php

namespace Brain\Games\Even;

use function Brain\Games\Engine\game;
use function Brain\Games\Helpers\isEven;

const MIN_RANDOM_VALUE = 0;
const MAX_RANDOM_VALUE = 100;

const TRUE_ANSWER = 'yes';
const FALSE_ANSWER = 'no';

function run()
{
    game(
        'Answer "yes" if the number is even, otherwise answer "no".',
        function () {
            $randomValue = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);

            return [
                (string)$randomValue,
                (isEven($randomValue) ? TRUE_ANSWER : FALSE_ANSWER)
            ];
        }
    );
}
