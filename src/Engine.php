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
        ['expression' => $expression, 'correctAnswer' => $correctAnswer, 'welcomeMsg' => $welcomeMsg] = $game();

        if ($rounds === $maxLevel) {
            showWelcomeMessage($welcomeMsg);
        }

        $isGameOver = askQuestion($expression, $correctAnswer);
        $rounds--;
    }

    !$isGameOver ? winGame($name) : gameOver($name);
}

function askQuestion(string $expression, string $correctAnswer): bool
{
    $userAnswer = prompt("Question: {$expression}");
    $errorMsg = "'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'";

    if (checkAnswersToMatch($userAnswer, $correctAnswer)) {
        showSuccessMessage();
        return false;
    } else {
        showErrorMessage($errorMsg);
        return true;
    }
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
