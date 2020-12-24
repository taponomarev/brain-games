<?php

namespace Brain\Games\BrainPrime;

use function Brain\Utils\getRandomNumber;
use function Brain\Engine\run;

function startGame()
{
    $manageGame = function () {
        $welcomeMsg = 'Answer "yes" if given number is prime. Otherwise answer "no".';
        $minPrimeNumber = 1;
        $maxPrimeNumber = 50;
        $expression = getRandomNumber($minPrimeNumber, $maxPrimeNumber);
        $correctAnswer = getCorrectAnswer($expression);

        return [
            'expression' => $expression,
            'correctAnswer' => $correctAnswer,
            'welcomeMsg' => $welcomeMsg
        ];
    };

    run($manageGame);
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
