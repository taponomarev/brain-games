<?php

namespace Brain\Games\BrainEven;

use function Brain\Utils\getRandomNumber;
use function Brain\Engine\run;

function startGame()
{
    $manageGame = function () {
        $welcomeMsg = 'Answer "yes" if the number is even, otherwise answer "no".';
        $expression = getRandomNumber();
        $correctAnswer = getCorrectAnswer($expression);

        return [
            'expression' => $expression,
            'correctAnswer' => $correctAnswer,
            'welcomeMsg' => $welcomeMsg
        ];
    };

    run($manageGame);
}

function hasEven(string $number)
{
    return $number % 2 === 0;
}

function getCorrectAnswer(string $number): string
{
    return hasEven($number) ? 'yes' : 'no';
}
