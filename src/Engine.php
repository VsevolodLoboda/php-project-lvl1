<?php

namespace BrainGames\Engine;

use function BrainGames\Cli\readInput;
use function BrainGames\Cli\printLine;
use function BrainGames\Helpers\criticalError;

const WIN_CONDITION_NUMBER = 3; // Number of correct answers needed to win

const TRUE_ANSWER = 'yes'; // Positive response to closed questions
const FALSE_ANSWER = 'no'; // Negative response to closed questions

/**
 * Launches the game with a given configuration
 *
 * @param string $gameDescription A string defining what needs to be done in the game
 * @param callable $generateQuestionAnswer Question and answer generator
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
 * Converts the boolean representation of the answer to a string
 *
 * @param bool $answer Answer in boolean representation
 * @return string Human representation
 */
function boolToHumanAnswer(bool $answer): string
{
    return $answer ? TRUE_ANSWER : FALSE_ANSWER;
}

/**
 * Replace placeholder in text with TRUE_ANSWER and FALSE_ANSWER constant
 *
 * @param string $text Test with placeholders
 * @return string
 */
function replaceAnswersPlaceholder(string $text): string
{
    return vsprintf($text, [
        TRUE_ANSWER,
        FALSE_ANSWER
    ]);
}
