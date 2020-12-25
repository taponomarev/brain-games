<?php

namespace Brain\Games\BrainGcd;

use function Brain\Utils\getRandomNumber;
use function Brain\Engine\run;

function startGame()
{
    $manageGame = function () {
        $welcomeMsg = 'Find the greatest common divisor of given numbers.';
        $firstNumber = getRandomNumber();
        $secondNumber = getRandomNumber();
        $expression = "{$firstNumber} {$secondNumber}";
        $correctAnswer = getCorrectAnswer($firstNumber, $secondNumber);

        return [
            'expression' => $expression,
            'correctAnswer' => $correctAnswer,
            'welcomeMsg' => $welcomeMsg
        ];
    };

    run($manageGame);
}

function getCorrectAnswer(string $firstNumber, string $secondNumber): int
{
    return calculateDenom($firstNumber, $secondNumber);
}

function calculateDenom(string $firstNumber, string $secondNumber): int
{
    $minNumberSize = $firstNumber < $secondNumber ? $firstNumber : $secondNumber;
    $denom = 1;

    for ($i = 1; $i <= $minNumberSize; $i++) {
        if ($firstNumber % $i === 0 && $secondNumber % $i === 0) {
            $denom = $i;
        }
    }

    return $denom;
}
