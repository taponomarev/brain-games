<?php

namespace Brain\Utils;

function getRandomNumber(int $minNumber = 1, int $maxNumber = 100): int
{
    return rand($minNumber, $maxNumber);
}
