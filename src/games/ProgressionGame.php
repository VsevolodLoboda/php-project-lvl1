<?php

namespace Brain\Games\Progression;

use function Brain\Games\Engine\runBrainGame;
use function Brain\Games\Helpers\genAProgression;

const GAME_DESCRIPTION = 'What number is missing in the progression?';

const MIN_RANDOM_VALUE = 1;
const MAX_RANDOM_VALUE = 200;
const PROGRESSION_LENGTH = 10;

const PROGRESSION_DELIMITER = ' ';
const PROGRESSION_PLACEHOLDER = '..';

/**
 * Run the game
 */
function run(): void
{
    $questionGenerator = function () {
        $progression = genAProgression(
            MIN_RANDOM_VALUE,
            MAX_RANDOM_VALUE,
            PROGRESSION_LENGTH
        );
        $replaceIndex = array_rand($progression);

        $answer = $progression[$replaceIndex];
        $progression[$replaceIndex] = PROGRESSION_PLACEHOLDER;

        return [
            implode(PROGRESSION_DELIMITER, $progression),
            $answer
        ];
    };

    runBrainGame(GAME_DESCRIPTION, $questionGenerator);
}
