<?php

namespace Brain\Games\BrainEven;

use function Brain\Engine\run;

function startGame()
{
    $manageGame = function () {
        $welcomeMsg = 'Answer "yes" if the number is even, otherwise answer "no".';
        $expression = rand();
        $correctAnswer = getCorrectAnswer($expression);

        return [
            'expression' => $expression,
            'correctAnswer' => $correctAnswer,
            'welcomeMsg' => $welcomeMsg
        ];
    };

    run($manageGame);
}

function isEven(string $number)
{
    return $number % 2 === 0;
}

function getCorrectAnswer(string $number): string
{
    return isEven($number) ? 'yes' : 'no';
}
