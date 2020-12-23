<?php

namespace Brain\Games\BrainPrime;

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
    line('Answer "yes" if given number is prime. Otherwise answer "no".');
}

function isPrime($number): bool
{
    return \gmp_prob_prime($number);
}

function getCorrectAnswer($number): string
{
    return isPrime($number) ? 'yes' : 'no';
}

function askAQuestion()
{
    $randomNumber = getRandomNumber();

    try {
        $answer = prompt("Question: {$randomNumber}");
        $correctAnswer = getCorrectAnswer($randomNumber);

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
