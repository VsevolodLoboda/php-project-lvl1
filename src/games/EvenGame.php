<?php

namespace Brain\Games\Even;

use function Brain\Games\Engine\runBrainGame;
use function Brain\Games\Helpers\boolToHumanAnswer;
use function Brain\Games\Helpers\replaceAnswersPlaceholder;

const GAME_DESCRIPTION = 'Answer "%s" if the number is even, otherwise answer "%s".';

const MIN_RANDOM_VALUE = 0;
const MAX_RANDOM_VALUE = 100;

/**
 * Run the game
 */
function run(): void
{
    $questionGenerator = function () {
        $question = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
        $answer = boolToHumanAnswer(isEven($question));

        return [
            (string)$question,
            $answer
        ];
    };

    runBrainGame(
        replaceAnswersPlaceholder(GAME_DESCRIPTION),
        $questionGenerator
    );
}

/**
 * Determines if the number is even
 *
 * @param int $number Verifiable number
 * @return bool
 */
function isEven(int $number): bool
{
    return $number % 2 === 0;
}
