<?php

namespace Brain\Games\Progression;

use function Brain\Games\Engine\runBrainGame;
use function Brain\Games\Helpers\criticalError;

const GAME_DESCRIPTION = 'What number is missing in the progression?';

const MIN_PROGRESSION_START_VALUE = 1;
const MAX_PROGRESSION_START_VALUE = 100;

const MIN_STEP = 1;
const MAX_STEP = 15;

const PROGRESSION_LENGTH = 10;

const PROGRESSION_DELIMITER = ' ';
const PROGRESSION_PLACEHOLDER = '..';

/**
 * Run the game
 */
function run(): void
{
    $generateQuestionAnswer = function () {
        $progression = genAProgression(
            mt_rand(MIN_PROGRESSION_START_VALUE, MAX_PROGRESSION_START_VALUE),
            mt_rand(MIN_STEP, MAX_STEP),
            PROGRESSION_LENGTH
        );
        $replaceIndex = array_rand($progression);

        $answer = (string)$progression[$replaceIndex];

        $progression[$replaceIndex] = PROGRESSION_PLACEHOLDER;
        $question = implode(PROGRESSION_DELIMITER, $progression);

        return [
            $question,
            $answer
        ];
    };

    runBrainGame(GAME_DESCRIPTION, $generateQuestionAnswer);
}

/**
 * Creates an arithmetic progression of a given length
 *
 * @param int $startValue Start value of progression
 * @param int $step Step of progression
 * @param int $length Number of values in the progression
 * @return array Progression
 */
function genAProgression(int $startValue, int $step, int $length): array
{
    $endValue = $startValue + $step * ($length - 1);
    return range($startValue, $endValue, $step);
}
