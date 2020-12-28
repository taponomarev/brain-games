<?php

namespace Brain\Games\BrainCalc;

use Exception;

use function Brain\Engine\run;

const DESCRIPTION = 'What is the result of the expression?';

function startGame()
{
    $getParams = function () {
        [$firstNumber, $secondNumber, $operation] = getRandomExpression();
        $expression = "{$firstNumber} {$operation} {$secondNumber}";
        $correctAnswer = getCorrectAnswer($firstNumber, $secondNumber, $operation);

        return [
            'expression' => $expression,
            'correctAnswer' => $correctAnswer
        ];
    };

    run($getParams, DESCRIPTION);
}

function getRandomExpression(): array
{
    $operations = ['+', '-', '*'];

    $firstNumber = rand();
    $secondNumber = rand();
    $operation = $operations[rand(0, count($operations) - 1)];

    return [$firstNumber, $secondNumber, $operation];
}

function getCorrectAnswer(string $firstNumber, string $secondNumber, string $operation): string
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
        default:
            throw new Exception("Unknown operation state: '{$operation}'!");
    }
}
