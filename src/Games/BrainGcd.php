<?php

namespace Brain\Games\BrainGcd;

use function Brain\Utils\getRandomNumber;
use function Brain\Engine\run;
use function Brain\Engine\askQuestion;
use function Brain\Engine\showWelcomeMessage;
use function Brain\Engine\checkAnswersToMatch;
use function Brain\Engine\showSuccessMessage;
use function Brain\Engine\showErrorMessage;

function startGame()
{
    $welcomeMsg = 'Find the greatest common divisor of given numbers.';
    $manageGame = function ($showWelcomeMessage = false) use ($welcomeMsg) {
        if ($showWelcomeMessage) {
            showWelcomeMessage($welcomeMsg);
        }

        $firstNumber = getRandomNumber();
        $secondNumber = getRandomNumber();
        $userAnswer = askQuestion("Question: {$firstNumber} {$secondNumber}");
        $correctAnswer = getCorrectAnswer($firstNumber, $secondNumber);
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

function getCorrectAnswer($firstNumber, $secondNumber)
{
    return calculateDenom($firstNumber, $secondNumber);
}

function calculateDenom($firstNumber, $secondNumber)
{
    $minNumberSize = $firstNumber < $secondNumber ? $firstNumber : $secondNumber;
    $denom = 1;

    for ($i = 1; $i <= $minNumberSize; $i++) {
        if ($firstNumber % $i === 0 && $secondNumber % $i === 0) {
            $denom = $i;
        }
    }

    return $denom;
}
