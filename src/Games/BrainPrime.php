<?php

namespace Brain\Games\BrainPrime;

use function Brain\Utils\getRandomNumber;
use function Brain\Engine\run;
use function Brain\Engine\askQuestion;
use function Brain\Engine\showWelcomeMessage;
use function Brain\Engine\checkAnswersToMatch;
use function Brain\Engine\showSuccessMessage;
use function Brain\Engine\showErrorMessage;

function startGame()
{
    $welcomeMsg = 'Answer "yes" if given number is prime. Otherwise answer "no".';
    $manageGame = function ($showWelcomeMessage = false) use ($welcomeMsg) {
        if ($showWelcomeMessage) {
            showWelcomeMessage($welcomeMsg);
        }

        $randomNumber = getRandomNumber(1, 50);
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

function isPrime($number): bool
{
    for ($i = 3; $i <= $number; $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}

function getCorrectAnswer($number): string
{
    return isPrime($number) ? 'yes' : 'no';
}
