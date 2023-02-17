<?php
////////////////////////////////////////////////
// Erros de execusão "EM PRODUÇÃO"
error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', __DIR__ . '/error.log');
////////////////////////////////////////////////

// Fixar o buffer do cabeçalho
ob_start();

// Dados para definir configurações de conexões
$con = require_once(SYSTEM_DIR . 'config/connections.php');

// Dados para definir configurações de comportamento
$setting = require_once(SYSTEM_DIR . 'config/settings.php');

try {
    if (!isset($con['ready'])) {
        throw new Exception('Dados de configurações para conexão não definidos', E_ERROR);
    } else if (!isset($setting['ready'])) {
        throw new Exception('Dados de configurações de comportamento não definidos', E_ERROR);
    } else {
        // Constantes para conexão com o banco de dados
        defined('DB_HOST') || define('DB_HOST', $con['dbHost']);
        defined('DB_USER') || define('DB_USER', $con['dbUser']);
        defined('DB_PASS') || define('DB_PASS', $con['dbPass']);
        defined('DB_DATA') || define('DB_DATA', $con['dbName']);

        // Constantes para conexão com o servidor SMTP
        defined('MAIL_TYPE') || define('MAIL_TYPE', $con['mailType']);
        defined('MAIL_HOST') || define('MAIL_HOST', $con['mailHost']);
        defined('MAIL_PORT') || define('MAIL_PORT', $con['mailPort']);
        defined('MAIL_USER') || define('MAIL_USER', $con['mailUser']);
        defined('MAIL_PASS') || define('MAIL_PASS', $con['mailPass']);
        defined('MAIL_CHAR') || define('MAIL_CHAR', $con['mailChar']);

        // Fuso horário do servidor
        date_default_timezone_set('America/Sao_Paulo');

        // Auto carregamento de classes
        require_once (SYSTEM_DIR . '/function/LoadClass.php');

        // 
        $config = GlobalFilter::ObjArray($setting);
    }
} catch (Exception $e) {
    header('location : http500/');
}
