<?php

namespace Brain\Games\Calc;

use function Brain\Games\Engine\runBrainGame;
use function Brain\Games\Helpers\criticalError;

const GAME_DESCRIPTION = 'What is the result of the expression?';

const MIN_RANDOM_VALUE = 0;
const MAX_RANDOM_VALUE = 100;

const MATH_OPERATIONS = ['+', '-', '*'];

/**
 * Run the game
 */
function run(): void
{
    $questionGenerator = function () {
        list($value1, $operation, $value2, $result) = generateMathExpression(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);

        $generatedNumber1 = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
        $generatedNumber2 = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
        $operation = MATH_OPERATIONS[array_rand(MATH_OPERATIONS)];

        $question = "$value1 $operation $value2";
        $answer = calcMathExpression($operation, $generatedNumber1, $generatedNumber2);

        return [
            $question,
            $answer
        ];
    };

    runBrainGame(GAME_DESCRIPTION, $questionGenerator);
}

/**
 * Calculates a mathematical expression
 *
 * @param int $v1 First operand
 * @param string $operator Math operator ['+','-','*','/']
 * @param int $v2 Second operand
 * @return int Result of math expression
 */
function calcMathExpression(string $operator, int $v1, int $v2): int
{
    $result = null;

    switch ($operator) {
        case '+':
            $result = $v1 + $v2;
            break;
        case '-':
            $result = $v1 - $v2;
            break;
        case '*':
            $result = $v1 * $v2;
            break;
        case '/':
            $result = $v1 / $v2;
            break;
        default:
            criticalError("Unsupported math operator '$operator'");
    }

    return $result;
}
