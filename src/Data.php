<?php

namespace Brain\Data;

function getMaxLevel()
{
    return 3;
}

function getGames()
{
    return [
        'Brain\Games\BrainEven\runGame',
        'Brain\Games\BrainCalc\runGame',
        'Brain\Games\BrainPrime\runGame',
        'Brain\Games\BrainGcd\runGame'
    ];
}
