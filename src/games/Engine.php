<?php

namespace Brain\Games\Engine;

use function Brain\Games\Cli\printLine;
use function Brain\Games\Cli\promt;
use function Brain\Games\Cli\runGreetings;

const ALLOW_MISTAKES_NUMBER = 0;
const WIN_CONDITION_NUMBER = 3;

function game(string $gameDescription, callable $questionAnswerGenerator): void
{
    $userName = runGameGreetings($gameDescription);
    $isGameWon = runGame($questionAnswerGenerator);
    runGameEnd($userName, $isGameWon);
}

function runGameGreetings(string $gameDescription): string
{
    $userName = runGreetings();
    printLine($gameDescription);
    return $userName;
}

function runGame(callable $questionGenerator): bool
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

function runGameEnd(string $userName, bool $isGameWon): void
{
    if ($isGameWon) {
        printLine("Congratulations, $userName!");
    } else {
        printLine("Let's try again, $userName!");
    }
}

function printQuestion(string $question): void
{
    printLine("Question: $question");
}

function askUserAnswer(): string
{
    return trim(promt('Your answer'));
}
