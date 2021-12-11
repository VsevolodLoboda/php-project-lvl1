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
        return [
            "$value1 $operation $value2",
            $result
        ];
    };

    runBrainGame(GAME_DESCRIPTION, $questionGenerator);
}

/**
 * Generates a mathematical expression with the answer
 *
 * @param int $minValue Minimum value of the generated number
 * @param int $maxValue Maximum value of the generated number
 * @return array [0] - value #1, [1] - math operator, [2] - value #2, [3] - calculated result
 */
function generateMathExpression(int $minValue, int $maxValue): array
{
    $generatedNumber1 = mt_rand($minValue, $maxValue);
    $generatedNumber2 = mt_rand($minValue, $maxValue);
    $operation = MATH_OPERATIONS[array_rand(MATH_OPERATIONS)];

    $result = calcMathExpression($operation, $generatedNumber1, $generatedNumber2);

    return [
        $generatedNumber1,
        $operation,
        $generatedNumber2,
        $result
    ];
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
