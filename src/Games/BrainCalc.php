<?php

namespace Brain\Games\BrainCalc;

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
    line('What is the result of the expression?');
}

function getRandomExpression()
{
    $operations = ['+', '-', '*'];

    $firstNumber = getRandomNumber();
    $secondNumber = getRandomNumber();
    $operation = $operations[rand(0, count($operations) - 1)];

    return [$firstNumber, $secondNumber, $operation];
}

function askAQuestion()
{
    [$firstNumber, $secondNumber, $operation] = getRandomExpression();

    try {
        $answer = prompt("Question {$firstNumber} {$operation} {$secondNumber}");
        $correctAnswer = getCorrectAnswer($firstNumber, $secondNumber, $operation);

        if ($answer === $correctAnswer) {
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

function getCorrectAnswer($firstNumber, $secondNumber, $operation): string
{
    switch ($operation) {
        case '+':
            return $firstNumber + $secondNumber;
            break;
        case '-':
            return $firstNumber - $secondNumber;
            break;
        case '*':
            return $firstNumber * $secondNumber;
            break;
    }
}
