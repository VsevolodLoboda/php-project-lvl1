<?php

namespace Brain\Games\Even;

use function Brain\Games\Cli\runGreetings;
use function Brain\Games\Cli\printLine;
use function Brain\Games\Cli\promt;

const MIN_RANDOM_VALUE = 0;
const MAX_RANDOM_VALUE = 100;

const ALLOW_MISTAKES_NUMBER = 0;
const WIN_CONDITION_NUMBER = 3;

const TRUE_ANSWER = 'yes';
const FALSE_ANSWER = 'no';

function run()
{
    $userName = runGameGreetings();
    $isGameWon = runGame();
    runGameEnd($userName, $isGameWon);
}

function runGameGreetings(): string
{
    $userName = runGreetings();
    printLine('Answer "yes" if the number is even, otherwise answer "no".');
    return $userName;
}

function runGame(): bool
{
    $numberOfCorrectAnswers = 0;
    $numberOfMistakes = 0;

    while ($numberOfCorrectAnswers < WIN_CONDITION_NUMBER && $numberOfMistakes <= ALLOW_MISTAKES_NUMBER) {
        $generatedNumber = mt_rand(MIN_RANDOM_VALUE, MAX_RANDOM_VALUE);
        printQuestion($generatedNumber);

        $answer = askUserAnswer();
        $rightAnswer = determineRightAnswer($generatedNumber);

        if (strtolower($answer) !== strtolower($rightAnswer)) {
            printLine("'{$answer}' is wrong answer ;(. Correct answer was '{$rightAnswer}'.");
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
        printLine("Congratulations, ${userName}!");
    } else {
        printLine("Let's try again, {$userName}!");
    }
}

function determineRightAnswer(int $number): string
{
    $isEven = $number % 2 === 0;
    return $isEven ? TRUE_ANSWER : FALSE_ANSWER;
}

function printQuestion(string $question): void
{
    printLine("Question: ${question}");
}

function askUserAnswer(): string
{
    return trim(promt('Your answer'));
}
