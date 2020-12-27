<?php

namespace Brain\Engine;

use function cli\line;
use function cli\prompt;
use function cli\err;

function run(callable $game)
{

    line('Welcome to the Brain Games!');
    $username = prompt('May I have your name?');
    line("Hello, %s!", $username);
    tickGame($game, $username);
}

function tickGame(callable $game, string $username, int $currentLevel = 3)
{
    if (!$currentLevel) {
        line("Congratulations, {$username}");
        return;
    }

    $maxLevel = 3;
    ['expression' => $expression, 'correctAnswer' => $correctAnswer, 'welcomeMsg' => $welcomeMsg] = $game();

    if ($currentLevel === $maxLevel) {
        line($welcomeMsg);
    }

    $userAnswer = prompt("Question: {$expression}");
    $errorMsg = "'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'";

    if ($userAnswer == $correctAnswer) {
        line('Correct!');
        tickGame($game, $username, $currentLevel -= 1);
    } else {
        err($errorMsg);
        err("Let's try again, {$username}!");
        return;
    }
}
