<?php
/*-------------------------------------------*\
|    ______ ____ _____ ___   __               |
|   / ____ / _  / ____/  /  /  /              |
|   \___  /  __/ __/ /  /__/  /___            |
|  /_____/_ / /____//_____/______/            |
|       /\  /|   __    __________ _________   |
|      /  \/ |  /  |  /  ___  __/ ___/ _  /   |
|     /      | / ' | _\  \ / / / __//  __/    |
|    /  /\/| |/_/|_|/____//_/ /____/_/\ \     |
|   /__/   |_|     PHP Script          \/     |
|                                             |
+---------------------------------------------+
| @copyright: (c) 2017, Omar Pautz/ Zeed      |
| @version: 6.0 (?/?/2021)                    |
| @description: Auto carregamento de classes  |
\*-------------------------------------------*/

spl_autoload_register(function ($Class) {
    $includeDir = false;
    $findDir = [
        'database',
        'helper',
        'mailer',
        'model'
    ];
    foreach ($findDir as $DirName) {
        if (!$includeDir
            && file_exists(__DIR__ . FindClass($DirName, $Class))
            && !is_dir(__DIR__ . FindClass($DirName, $Class))) {
            include_once (__DIR__ . FindClass($DirName, $Class));
            $includeDir = true;
        }
    }
    if (!$includeDir) {
        die("Erro interno no servidor ao encontrar dados cruciais de funcionamento!");
    }
});

function FindClass($dir, $class) {
    return (
        DIRECTORY_SEPARATOR
        . '..'
        . DIRECTORY_SEPARATOR . 'class'
        . DIRECTORY_SEPARATOR . $dir
        . DIRECTORY_SEPARATOR . $class . '.php'
    );
}
