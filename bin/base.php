<?php

function cmdRun($text, $command, $canFail = false)
{
    $cmdLength = strlen($command);

    echo "\nTask: $text\n$command\n";

    for ($i = 1; $i <= $cmdLength + 3; $i++) {
        echo '=';
    }

    echo "\n";
    passthru($command, $return);

    if (0 !== $return && !$canFail) {
        echo "\n/!\\ The command returned $return\n";
        exit;
    }
}
