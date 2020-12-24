<?php

namespace Brain\Games\BrainProgression;

use function Brain\Utils\getRandomNumber;
use function Brain\Engine\run;
use function Brain\Engine\askQuestion;
use function Brain\Engine\showWelcomeMessage;
use function Brain\Engine\checkAnswersToMatch;
use function Brain\Engine\showSuccessMessage;
use function Brain\Engine\showErrorMessage;

function startGame()
{
    $welcomeMsg = 'What number is missing in the progression?';
    $manageGame = function ($showWelcomeMessage = false) use ($welcomeMsg) {
        if ($showWelcomeMessage) {
            showWelcomeMessage($welcomeMsg);
        }

        [$progression, $correctAnswer] = getProgression();
        $userAnswer = askQuestion("Question: {$progression}");
        $errorMsg = "'{$userAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'";

        if (checkAnswersToMatch($userAnswer, $correctAnswer)) {
            showSuccessMessage();
            return false;
        } else {
            showErrorMessage($errorMsg);
            return true;
        }
    };

    run($manageGame);
}

function getProgression()
{
    $progressionLength = 10;
    $progressionSymbol = '..';
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
    $progression[$randIdx] = $progressionSymbol;
    return [
        implode(" ", $progression),
        $randNumber
    ];
}
