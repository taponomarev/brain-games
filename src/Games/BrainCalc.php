<?php

namespace Brain\Games\BrainCalc;

use Exception;

use function Brain\Utils\getRandomNumber;
use function Brain\Engine\run;
use function Brain\Engine\askQuestion;
use function Brain\Engine\showWelcomeMessage;
use function Brain\Engine\checkAnswersToMatch;
use function Brain\Engine\showSuccessMessage;
use function Brain\Engine\showErrorMessage;

function startGame()
{
    $welcomeMsg = 'What is the result of the expression?';
    $manageGame = function ($showWelcomeMessage = false) use ($welcomeMsg) {
        if ($showWelcomeMessage) {
            showWelcomeMessage($welcomeMsg);
        }

        [$firstNumber, $secondNumber, $operation] = getRandomExpression();
        $userAnswer = askQuestion("Question: {$firstNumber} {$operation} {$secondNumber}");
        $correctAnswer = getCorrectAnswer($firstNumber, $secondNumber, $operation);
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

function getRandomExpression()
{
    $operations = ['+', '-', '*'];

    $firstNumber = getRandomNumber();
    $secondNumber = getRandomNumber();
    $operation = $operations[rand(0, count($operations) - 1)];

    return [$firstNumber, $secondNumber, $operation];
}

function getCorrectAnswer($firstNumber, $secondNumber, $operation): string
{
    switch ($operation) {
        case '+':
            return $firstNumber + $secondNumber;
            break;
        case '-':
            return $firstNumber - $secondNumber;
            break;
        case '*':
            return $firstNumber * $secondNumber;
            break;
        default:
            throw new Exception("Unknown operation state: '{$operation}'!");
    }
}
