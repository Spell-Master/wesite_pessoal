<?php

/**
 * ****************************************
 * @param STR $request
 * Informar o valor de $_GET['url'][0]
 * ****************************************
 */
function LoadModule($request) {
    if ($request == 'teste') { /* Testes de produção */
        return (MODULE_DIR . '_TESTE_.php');
    }

    $map = require (SYSTEM_DIR . 'config/site-map.php');
    $folder = false;
    foreach ($map as $key => $value) {
        if (($request == $value) || (is_array($value) && in_array($request, $value))) {
            $folder = $key;
            break;
        }
    }
    if ($folder) {
        return (MODULE_DIR . $folder . DIRECTORY_SEPARATOR . 'default.php');
    } else {
        return (MODULE_DIR . 'error' . DIRECTORY_SEPARATOR . '404.php');
    }
}
