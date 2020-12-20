<?php

namespace Brain\Games\BrainEven;

use function Brain\Games\Cli\run;
use function cli\line;
use function cli\prompt;
use function cli\err;

function runGame()
{
    $attempts = 3;
    $isGameOver = false;

    line('Welcome to the Brain Games!');

    try {
        $name = prompt('May I have your name?');
        line("Hello, %s!", $name);
        line('Answer "yes" if the number is even, otherwise answer "no".');

        while ($attempts && !$isGameOver) {
            askAQuestion($isGameOver);
            $attempts--;
        }

        if ($isGameOver) {
            gameOver($name);
        } else {
            winGame($name);
        }
    } catch (\Exception $e) {
        err($e->getMessage());
    }
}

function getRandomNumber()
{
    $minNumber = 1;
    $maxNumber = 100;
    return rand($minNumber, $maxNumber);
}

function isEven($number)
{
    return $number % 2 === 0;
}

function getCorrectAnswer($number): string
{
    return isEven($number) ? 'yes' : 'no';
}

function askAQuestion(&$isGameOver)
{
    $randomNumber = getRandomNumber();

    try {
        $answer = prompt('Question: ', $randomNumber);
        $correctAnswer = getCorrectAnswer($randomNumber);

        if ($answer === $correctAnswer) {
            line('Correct!');
        } else {
            line("'{$answer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'");
            $isGameOver = true;
        }
    } catch (\Exception $e) {
        err($e->getMessage());
    }
}

function winGame($userName)
{
    line("Congratulations, {$userName}");
}

function gameOver($userName)
{
    line("Let's try again, {$userName}!");
}
