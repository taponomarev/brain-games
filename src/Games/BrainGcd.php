<?php

namespace Brain\Games\BrainGcd;

use function Brain\Engine\run;

const DESCRIPTION = 'Find the greatest common divisor of given numbers.';

function startGame()
{
    $getParams = function () {
        $minNumber = 1;
        $maxNumber = 100;
        $firstNumber = rand($minNumber, $maxNumber);
        $secondNumber = rand($minNumber, $maxNumber);
        $expression = "{$firstNumber} {$secondNumber}";
        $correctAnswer = calculateDenom($firstNumber, $secondNumber);

        return [
            'expression' => $expression,
            'correctAnswer' => $correctAnswer
        ];
    };

    run($getParams, DESCRIPTION);
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
