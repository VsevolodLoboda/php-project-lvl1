<?php

namespace Brain\Games\Progression;

use function Brain\Games\Engine\runBrainGame;
use function Brain\Games\Helpers\criticalError;

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

        $progression[$replaceIndex] = PROGRESSION_PLACEHOLDER;

        $question = implode(PROGRESSION_DELIMITER, $progression);
        $answer = $progression[$replaceIndex];

        return [
            $question,
            $answer
        ];
    };

    runBrainGame(GAME_DESCRIPTION, $questionGenerator);
}

/**
 * Generates an arithmetic progression of a given length
 *
 * @param int $lowRange Lower threshold for generating values in the progression
 * @param int $topRange Top threshold for generating values in the progression
 * @param int $length Number of values in the progression
 * @return array Progression
 */
function genAProgression(int $lowRange = 1, int $topRange = 1000, int $length = 10): array
{
    $maxStep = (int)floor($topRange / $length);
    if ($maxStep < $lowRange) {
        criticalError(
            'Incorrect parameters for progression generation: ' .
            "low=$lowRange;top=$topRange;length=$length"
        );
    }

    $step = mt_rand($lowRange, $maxStep);
    $range = range($lowRange, $topRange, $step);

    $spliceOffset = mt_rand(0, count($range) - $length);

    return array_splice($range, $spliceOffset, $length);
}
