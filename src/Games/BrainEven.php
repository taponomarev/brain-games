<?php

namespace Brain\Games\BrainEven;

use function Brain\Engine\run;

const DESCRIPTION = 'Answer "yes" if the number is even, otherwise answer "no".';

function startGame()
{
    $params = function () {
        $expression = rand();
        $correctAnswer = getCorrectAnswer($expression);

        return [
            'expression' => $expression,
            'correctAnswer' => $correctAnswer
        ];
    };

    run($params, DESCRIPTION);
}

function isEven(string $number): bool
{
    return $number % 2 === 0;
}

function getCorrectAnswer(string $number): string
{
    return isEven($number) ? 'yes' : 'no';
}
