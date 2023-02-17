<?php

/**
 * ****************************************
 * @param STR $fileUrl
 * Informar o valor de $_GET['url'][0]
 * ****************************************
 */
function LoadPage($fileUrl) {
    if ($fileUrl == 'teste') { /* Testes de produção */
        return (PAGE_DIR . '_TESTE_.php');
    }
    $folder = pageFolder($fileUrl);
    if ($folder) {
        return (PAGE_DIR . $folder . DIRECTORY_SEPARATOR . 'default.php');
    } else {
        return (PAGE_DIR . 'error' . DIRECTORY_SEPARATOR . '404.php');
    }
}

function pageFolder($request) {
    switch ($request) {
        default: return (false);
        case 'inicio': return ('default');
        case 'administracao': return('admin');
        case 'app': return ('app');
        case 'perfil': return ('user');
        case 'mensagens': return ('msg');
        case 'notificacoes': return ('notify');
        case 'sobre': case 'termos': case 'privacidade': return('infos');
        case 'doc': return('doc');
        case 'comunidade': return('forum');
    }
}
