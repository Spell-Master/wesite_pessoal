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
| @copyright: (c) 2023, Omar Pautz            |
| @version: 1.0                               |
| @description: Obtem e separa em índices as  |
|  entradas da Super-Global $_GET obtidas     |
|  pela regra no htacess.                     |
| ------------------------------------------- |
| Modelo htacess:                             |
|                                             |
| RewriteEngine On                            |
| RewriteCond %{REQUEST_FILENAME} !-f         |
| RewriteCond %{REQUEST_FILENAME} !-d         |
| RewriteRule ^(.*)$ index.php?url=$1         |
\*-------------------------------------------*/

function UrlIndex() {
    $filter = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
    $setUrl = empty($filter) ? 'inicio' : $filter;
    $explode = explode('/', $setUrl);
    $arr = array_filter($explode);
    return ($arr);
}
