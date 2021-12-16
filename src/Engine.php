<?php

namespace Brain\Games\Engine;

use function Brain\Games\Cli\readInput;
use function Brain\Games\Cli\printLine;
use function Brain\Games\Helpers\criticalError;

const WIN_CONDITION_NUMBER = 3; // Number of correct answers needed to win

/**
 * Launches the game with a given configuration
 *
 * @param string $gameDescription A string defining what needs to be done in the game
 * @param callable $generateQuestionAnswer Question and answer generator {@see generateQuestionAnswerDemo()}
 */
function runBrainGame(string $gameDescription, callable $generateQuestionAnswer): void
{
    printLine('Welcome to the Brain Games!');
    $userName = readInput('Your answer');
    printLine($gameDescription);

    $score = 0;

    while ($score < WIN_CONDITION_NUMBER) {
        list($question, $answer) = $generateQuestionAnswer();

        if (gettype($question) !== 'string') {
            criticalError('Question generator error: question must be a string');
        }

        if (gettype($answer) !== 'string') {
            criticalError('Question generator error: answer must be a string');
        }

        printLine("Question: $question");
        $userAnswer = readInput('Your answer');

        if ($userAnswer !== $answer) {
            printLine("'$userAnswer' is wrong answer ;(. Correct answer was '$answer'.");
            printLine("Let's try again, $userName!");
            return;
        }

        printLine('Correct!');
        $score += 1;
    }

    printLine("Congratulations, $userName!");
}

/**
 * Generates a question and provides an answer
 *
 * @return string[] [0] - Question text, [1] - Answer text
 */
function generateQuestionAnswerDemo(): array
{
    return [
        'question',
        'answer'
    ];
}
