<?php

namespace Brain\Games\Engine;

use function Brain\Games\Cli\askUserAnswer;
use function Brain\Games\Cli\printLine;
use function Brain\Games\Cli\printQuestion;
use function Brain\Games\Cli\startGreetingsDialog;

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
    $userName = startGreetings($gameDescription);
    $isGameWon = startGameLogic($questionAnswerGenerator);
    startGameEnd($userName, $isGameWon);
}

/**
 * Launches the greeting dialog
 *
 * @param string $gameDescription A string defining what needs to be done in the game
 * @return string User name
 */
function startGreetings(string $gameDescription): string
{
    $userName = startGreetingsDialog();
    printLine($gameDescription);
    return $userName;
}

/**
 * Running the basic game logic
 *
 * @param callable $questionGenerator Question and answer generator {@see demoQuestionGenerator()}
 * @return bool Game result (win/loss)
 */
function startGameLogic(callable $questionGenerator): bool
{
    $numberOfCorrectAnswers = 0;
    $numberOfMistakes = 0;

    while ($numberOfCorrectAnswers < WIN_CONDITION_NUMBER && $numberOfMistakes <= ALLOW_MISTAKES_NUMBER) {
        list($question, $answer) = $questionGenerator();

        printQuestion($question);
        $userAnswer = askUserAnswer();

        if ($userAnswer !== (string)$answer) {
            printLine("'$userAnswer' is wrong answer ;(. Correct answer was '$answer'.");
            $numberOfMistakes += 1;
            continue;
        }

        printLine('Correct!');
        $numberOfCorrectAnswers += 1;
    }

    return $numberOfCorrectAnswers >= WIN_CONDITION_NUMBER && $numberOfMistakes <= ALLOW_MISTAKES_NUMBER;
}

/**
 * End of game
 *
 * @param string $userName
 * @param bool $isGameWon
 */
function startGameEnd(string $userName, bool $isGameWon): void
{
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
