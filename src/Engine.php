<?php

namespace Brain\Engine;

use function cli\line;
use function cli\prompt;
use function cli\err;

function run(callable $params, string $description)
{

    line('Welcome to the Brain Games!');
    $username = prompt('May I have your name?');
    line("Hello, %s!", $username);
    line($description);
    tickGame($params, $username);
}

function tickGame(callable $params, string $username, int $currentLevel = 3)
{
    if (!$currentLevel) {
        line("Congratulations, {$username}");
        return;
    }

    ['expression' => $expression, 'correctAnswer' => $correctAnswer] = $params();

    $userAnswer = prompt("Question: {$expression}");
    $errorMsg = "'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'";

    if ($userAnswer == $correctAnswer) {
        line('Correct!');
        tickGame($params, $username, $currentLevel -= 1);
    } else {
        err($errorMsg);
        err("Let's try again, {$username}!");
        return;
    }
}
