<?php

namespace Brain\Games\BrainProgression;

use function Brain\Engine\run;

const DESCRIPTION = 'What number is missing in the progression?';

function startGame()
{
    $params = function () {
        [$expression, $correctAnswer] = getProgression();

        return [
            'expression' => $expression,
            'correctAnswer' => $correctAnswer
        ];
    };

    run($params, DESCRIPTION);
}

function getProgression(): array
{
    $progressionMinLength = 5;
    $progressionMaxLength = 15;
    $stepMinLength = 1;
    $stepMaxLength = 10;
    $hiddenSymbol = '..';

    $step = rand($stepMinLength, $stepMaxLength);
    $progressionLength = rand($progressionMinLength, $progressionMaxLength);
    $progressionFirstNumber = rand($progressionMinLength, $progressionMaxLength);
    $progressionLastNumber = ($progressionLength - 1) * $step + $progressionFirstNumber;
    $progression = range($progressionFirstNumber, $progressionLastNumber, $step);
    $randIdx = rand(0, count($progression) - 1);
    $randNumber = $progression[$randIdx];
    $progression[$randIdx] = $hiddenSymbol;

    return [
        implode(" ", $progression),
        $randNumber
    ];
}
