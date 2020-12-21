<?php

namespace Brain\Engine;

use function cli\line;
use function cli\prompt;
use function cli\err;

function start()
{
    $games = [
        'Brain\Games\BrainEven\runGame',
        'Brain\Games\BrainCalc\runGame'
    ];
    $isGameOver = false;

    line('Welcome to the Brain Games!');
    try {
        $name = prompt('May I have your name?');
        line("Hello, %s!", $name);

        foreach ($games as $game) {
            $attempts = 3;

            while ($attempts && !$isGameOver) {
                $isGameOver = $game($attempts === 3 ? true : false);
                $attempts--;
            }

            if ($isGameOver) {
                break;
            }
        }

        !$isGameOver ? winGame($name) : gameOver($name);
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
