<?php

namespace Brain\Games\Prime;

use function Brain\Games\Helpers\boolToHumanAnswer;
use function Brain\Games\Engine\runBrainGame;
use function Brain\Games\Helpers\replaceAnswersPlaceholder;

const GAME_DESCRIPTION = 'Answer "%s" if given number is prime. Otherwise answer "%s".';

const MIN_RANDOM_VALUE = 1;
const MAX_RANDOM_VALUE = 200;

/**
 * Run the game
 */
function run(): void
{
    $generateQuestionAnswer = function () {
        $question = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
        $answer = boolToHumanAnswer(isPrime($question));

        return [
            (string)$question,
            $answer
        ];
    };

    runBrainGame(
        replaceAnswersPlaceholder(GAME_DESCRIPTION),
        $generateQuestionAnswer
    );
}

/**
 * Determines if the number is prime
 *
 * @param int $number Verifiable number
 * @return bool
 */
function isPrime(int $number): bool
{
    if ($number === 0 || $number === 1) {
        return false;
    }

    for ($x = 2; $x < $number; $x += 1) {
        // TODO: I'm not sure I've got how we can simplify this check to "$number / 2". Could you give complete example?
        if ($number % $x === 0) {
            return false;
        }
    }
    return true;
}
