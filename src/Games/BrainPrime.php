<?php

namespace Brain\Games\BrainPrime;

use function Brain\Engine\run;

const DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function startGame()
{
    $params = function () {
        $minPrimeNumber = 1;
        $maxPrimeNumber = 50;
        $expression = rand($minPrimeNumber, $maxPrimeNumber);
        $correctAnswer = getCorrectAnswer($expression);

        return [
            'expression' => $expression,
            'correctAnswer' => $correctAnswer,
            'description' => DESCRIPTION
        ];
    };

    run($params, DESCRIPTION);
}

function isPrime(string $number): bool
{
    for ($i = 3; $i <= $number; $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}

function getCorrectAnswer(string $number): string
{
    return isPrime($number) ? 'yes' : 'no';
}
