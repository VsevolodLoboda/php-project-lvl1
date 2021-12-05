<?php

namespace Brain\Games\Progression;

use function Brain\Games\Engine\game;
use function Brain\Games\Helpers\genAProgression;

const MIN_RANDOM_VALUE = 1;
const MAX_RANDOM_VALUE = 200;

function run()
{
    game(
        'What number is missing in the progression?',
        function () {
            $progression = genAProgression(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
            $replaceIndex = array_rand($progression);

            $answer = $progression[$replaceIndex];
            $progression[$replaceIndex] = '..';

            return [
                implode(' ', $progression),
                $answer
            ];
        }
    );
}
