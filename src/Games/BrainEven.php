<?php

namespace Brain\Games\BrainEven;

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
    line('Answer "yes" if the number is even, otherwise answer "no".');
}

function isEven($number)
{
    return $number % 2 === 0;
}

function getCorrectAnswer($number): string
{
    return isEven($number) ? 'yes' : 'no';
}

function askAQuestion()
{
    $randomNumber = getRandomNumber();

    try {
        $answer = prompt('Question: ', $randomNumber);
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
