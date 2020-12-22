<?php

namespace Brain\Games\BrainProgression;

use function cli\line;
use function cli\prompt;
use function cli\err;
use function Brain\Utils\getRandomNumber;

function runGame($showWelcomeMessage = false)
{
    if ($showWelcomeMessage) {
        showWelcomeMessage();
    }

    return askAQuestion();
}

function showWelcomeMessage()
{
    line('What number is missing in the progression?');
}

function getProgression()
{
    $progressionLength = 10;
    $firstNumber = getRandomNumber();
    $progressionDistance = rand(1, $progressionLength);
    $progression = [$firstNumber];

    for ($i = 0; $i < $progressionLength; $i++) {
        $lastNumber = $progression[count($progression) - 1];
        $nextNumber = $lastNumber + $progressionDistance;
        array_push($progression, $nextNumber);
    }

    $randIdx = rand(0, $progressionLength - 1);
    $randNumber = $progression[$randIdx];
    $progression[$randIdx] = '...';
    return [
        implode(" ", $progression),
        $randNumber
    ];
}

function askAQuestion()
{
    [$progression, $correctAnswer] = getProgression();

    try {
        $answer = prompt('Question: ', $progression);

        if ($answer == $correctAnswer) {
            line('Correct!');
        } else {
            line("'{$answer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'");
            return true;
        }
    } catch (\Exception $e) {
        err($e->getMessage());
        return true;
    }
}
