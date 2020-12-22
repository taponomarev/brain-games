<?php

namespace Brain\Engine;

use function cli\line;
use function cli\prompt;
use function cli\err;
use function Brain\Data\getMaxLevel;

function start(string $defaultGame)
{
    $games = [
        'Brain\Games\BrainEven\runGame',
        'Brain\Games\BrainCalc\runGame',
        'Brain\Games\BrainPrime\runGame'
    ];

    if ($defaultGame) {
        $games = [$defaultGame];
    }

    $isGameOver = false;

    line('Welcome to the Brain Games!');
    try {
        $name = prompt('May I have your name?');
        line("Hello, %s!", $name);

        foreach ($games as $game) {
            $rounds = getMaxLevel();
            $maxLevel = getMaxLevel();

            while ($rounds && !$isGameOver) {
                $isGameOver = $game($maxLevel === $rounds);
                $rounds--;
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
