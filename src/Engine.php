<?php

namespace Brain\Engine;

use function cli\line;
use function cli\prompt;
use function cli\err;

const MAX_LEVEL = 3;

function run(callable $params, string $description)
{

    $level = 0;

    line('Welcome to the Brain Games!');
    $username = prompt('May I have your name?');
    line("Hello, %s!", $username);
    line($description);
    tickGame($params, $username, $level);
}

function tickGame(callable $params, string $username, int $currentLevel)
{
    if ($currentLevel === MAX_LEVEL) {
        line("Congratulations, {$username}");
        return;
    }

    ['expression' => $expression, 'correctAnswer' => $correctAnswer] = $params();

    $userAnswer = prompt("Question: {$expression}");
    $errorMsg = "'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'";

    if ($userAnswer == $correctAnswer) {
        line('Correct!');
        tickGame($params, $username, $currentLevel += 1);
    } else {
        err($errorMsg);
        err("Let's try again, {$username}!");
        return;
    }
}
