<?php

namespace Brain\Games\BrainEven;

use function Brain\Utils\getRandomNumber;
use function Brain\Engine\run;
use function Brain\Engine\askQuestion;
use function Brain\Engine\showWelcomeMessage;
use function Brain\Engine\checkAnswersToMatch;
use function Brain\Engine\showSuccessMessage;
use function Brain\Engine\showErrorMessage;

function startGame()
{
    $welcomeMsg = 'Answer "yes" if the number is even, otherwise answer "no".';
    $manageGame = function ($showWelcomeMessage = false) use ($welcomeMsg) {
        if ($showWelcomeMessage) {
            showWelcomeMessage($welcomeMsg);
        }

        $randomNumber = getRandomNumber();
        $userAnswer = askQuestion("Question: {$randomNumber}");
        $correctAnswer = getCorrectAnswer($randomNumber);
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

function isEven($number)
{
    return $number % 2 === 0;
}

function getCorrectAnswer($number): string
{
    return isEven($number) ? 'yes' : 'no';
}
