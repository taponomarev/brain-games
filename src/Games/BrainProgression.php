<?php

namespace Brain\Games\BrainProgression;

use function Brain\Utils\getRandomNumber;
use function Brain\Engine\run;

function startGame()
{
    $manageGame = function () {
        $welcomeMsg = 'What number is missing in the progression?';
        [$expression, $correctAnswer] = getProgression();

        return [
            'expression' => $expression,
            'correctAnswer' => $correctAnswer,
            'welcomeMsg' => $welcomeMsg
        ];
    };

    run($manageGame);
}

function getProgression(): array
{
    $progressionMinLength = 5;
    $progressionMaxLength = 15;
    $stepMin = 1;
    $stepMax = 10;
    $progressionSymbol = '..';

    $step = getRandomNumber($stepMin, $stepMax);
    $progressionLength = rand($progressionMinLength, $progressionMaxLength);
    $firstNumber = getRandomNumber();
    $lastNumber = ($progressionLength * $step) + ($firstNumber - $step);
    $progression = range($firstNumber, $lastNumber, $step);
    $randIdx = rand(0, count($progression) - 1);
    $randNumber = $progression[$randIdx];
    $progression[$randIdx] = $progressionSymbol;

    return [
        implode(" ", $progression),
        $randNumber
    ];
}
