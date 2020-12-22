<?php

namespace Brain\Utils;

function getRandomNumber()
{
    $minNumber = 1;
    $maxNumber = 100;
    return rand($minNumber, $maxNumber);
}
