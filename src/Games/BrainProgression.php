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
    $stepMinLength = 1;
    $stepMaxNLength = 10;
    $progressionSymbol = '..';

    $step = getRandomNumber($stepMinLength, $stepMaxNLength);
    $progressionLength = getRandomNumber($progressionMinLength, $progressionMaxLength);
    $progressionFirstNumber = getRandomNumber();
    $progressionLastNumber = ($progressionLength * $step) + ($progressionFirstNumber - $step);
    $progression = range($progressionFirstNumber, $progressionLastNumber, $step);
    $randIdx = getRandomNumber(0, count($progression) - 1);
    $randNumber = $progression[$randIdx];
    $progression[$randIdx] = $progressionSymbol;

    return [
        implode(" ", $progression),
        $randNumber
    ];
}
