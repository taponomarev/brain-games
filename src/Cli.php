<?php

namespace Brain\Games\Cli;

use function cli\line;
use function cli\prompt;
use function cli\err;

function run()
{
    line('Welcome to the Brain Games!');

    try {
        $name = prompt('May I have your name?');
        line("Hello, %s!", $name);
    } catch (\Exception $e) {
        err($e->getMessage());
    }
}
