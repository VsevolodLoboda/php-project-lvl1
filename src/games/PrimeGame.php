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
    $questionGenerator = function () {
        $randomValue = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
        return [
            $randomValue,
            boolToHumanAnswer(isPrime($randomValue))
        ];
    };

    runBrainGame(
        replaceAnswersPlaceholder(GAME_DESCRIPTION),
        $questionGenerator
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
    for ($x = 2; $x < $number; $x += 1) {
        if ($number % $x == 0) {
            return false;
        }
    }
    return true;
}
