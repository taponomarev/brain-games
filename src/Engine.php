<?php

namespace Brain\Engine;

use function cli\line;
use function cli\prompt;
use function cli\err;
use function Brain\Data\getMaxLevel;

function run($game)
{
    $isGameOver = false;

    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);

    $rounds = getMaxLevel();
    $maxLevel = getMaxLevel();

    while ($rounds && !$isGameOver) {
        $isGameOver = $game($rounds === $maxLevel ? true : false);
        $rounds--;
    }

    !$isGameOver ? winGame($name) : gameOver($name);
}

function askQuestion(string $question)
{
    $userAnswer = prompt($question);
    return $userAnswer;
}

function checkAnswersToMatch(string $userAnswer, string $correctAnswer): bool
{
    return $userAnswer == $correctAnswer;
}

function showWelcomeMessage(string $message)
{
    line($message);
}

function showSuccessMessage(string $message = 'Correct!')
{
    line($message);
}

function showErrorMessage(string $message)
{
    err($message);
}

function winGame(string $userName)
{
    line("Congratulations, {$userName}");
}

function gameOver(string $userName)
{
    line("Let's try again, {$userName}!");
}
