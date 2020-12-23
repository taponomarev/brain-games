<?php

namespace Brain\Games\BrainGcd;

use function cli\line;
use function cli\prompt;
use function cli\err;
use function Brain\Utils\getRandomNumber;

function runGame($showWelcomeMessage = false)
{
    if ($showWelcomeMessage) {
        showWelcomeMessage();
    }

    return askAQuestion();
}

function showWelcomeMessage()
{
    line('Find the greatest common divisor of given numbers.');
}

function getGcd($firstNumber, $secondNumber)
{
    return gmp_gcd($firstNumber, $secondNumber);
}

function getCorrectAnswer($firstNumber, $secondNumber)
{
    return getGcd($firstNumber, $secondNumber);
}

function askAQuestion()
{
    $firstNumber = getRandomNumber();
    $secondNumber = getRandomNumber();

    try {
        $answer = prompt("Question: {$firstNumber} {$secondNumber}");
        $correctAnswer = getCorrectAnswer($firstNumber, $secondNumber);

        if ($answer == $correctAnswer) {
            line('Correct!');
        } else {
            line("'{$answer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'");
            return true;
        }
    } catch (\Exception $e) {
        err($e->getMessage());
        return true;
    }
}
