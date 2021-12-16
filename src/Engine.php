<?php

namespace Brain\Games\Engine;

use function Brain\Games\Cli\readInput;
use function Brain\Games\Cli\printLine;
use function Brain\Games\Cli\startGreetingsDialog;
use function Brain\Games\Helpers\criticalError;

const ALLOW_MISTAKES_NUMBER = 0; // The number of mistakes a user can make in the game
const WIN_CONDITION_NUMBER = 3; // Number of correct answers needed to win

/**
 * Launches the game with a given configuration
 *
 * @param string $gameDescription A string defining what needs to be done in the game
 * @param callable $questionAnswerGenerator Question and answer generator {@see demoQuestionGenerator()}
 */
function runBrainGame(string $gameDescription, callable $questionAnswerGenerator): void
{
    printLine('Welcome to the Brain Game!');
    $userName = readInput('Your answer');
    printLine($gameDescription);

    $numberOfCorrectAnswers = 0;
    $numberOfMistakes = 0;

    while ($numberOfCorrectAnswers < WIN_CONDITION_NUMBER && $numberOfMistakes <= ALLOW_MISTAKES_NUMBER) {
        list($question, $answer) = $questionAnswerGenerator();

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
            $numberOfMistakes += 1;
            continue;
        }

        printLine('Correct!');
        $numberOfCorrectAnswers += 1;
    }

    $isGameWon = $numberOfCorrectAnswers >= WIN_CONDITION_NUMBER && $numberOfMistakes <= ALLOW_MISTAKES_NUMBER;

    $endGameMessage = "Congratulations, $userName!";
    if (!$isGameWon) {
        $endGameMessage = "Let's try again, $userName!";
    }

    printLine($endGameMessage);
}

/**
 * Generates a question and provides an answer
 *
 * @return string[] [0] - Question text, [1] - Answer text
 */
function demoQuestionGenerator(): array
{
    return [
        'question',
        'answer'
    ];
}
