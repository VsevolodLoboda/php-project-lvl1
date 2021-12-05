<?php

namespace Brain\Games\Calc;

use function Brain\Games\Engine\game;

const MIN_RANDOM_VALUE = 0;
const MAX_RANDOM_VALUE = 100;

function run(): void
{
    game(
        'What is the result of the expression?',
        function () {
            list($value1, $operation, $value2, $result) = generateMathExpression(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
            return [
                "$value1 $operation $value2",
                (string)$result
            ];
        }
    );
}

function generateMathExpression(int $minValue, int $maxValue): array
{
    $mathOperations = ['+', '-', '*'];

    $generatedNumber1 = mt_rand($minValue, $maxValue);
    $generatedNumber2 = mt_rand($minValue, $maxValue);
    $operation = $mathOperations[array_rand($mathOperations)];

    $result = calcMathExpression($generatedNumber1, $operation, $generatedNumber2);

    return [
        $generatedNumber1,
        $operation,
        $generatedNumber2,
        $result
    ];
}

function calcMathExpression(int $v1, string $operator, int $v2): int
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
        default:
            // TODO: Error handling
    }

    return $result;
}
