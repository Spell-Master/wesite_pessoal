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
| @copyright: (c) 2017, Omar Pautz            |
| @version: 1.0 (?/?/2017)                    |
| @description: Obtem o diretório base do     |
|  sistema                                    |
\*-------------------------------------------*/

function BaseURI() {
    $serve = filter_input_array(INPUT_SERVER, FILTER_DEFAULT);
    $rootUrl = strlen($serve['DOCUMENT_ROOT']);
    $fileUrl = substr($serve['SCRIPT_FILENAME'], $rootUrl, -9);
    if ($fileUrl[0] == '/') {
        $baseDir = $fileUrl;
    } else {
        $baseDir = '/' . $fileUrl;
    }
    return ($baseDir);
}
