<!DOCTYPE html>
<?php
// Diretório para sistemas
defined('SYSTEM_DIR') || define('SYSTEM_DIR', __DIR__ . '/system/');
// Diretório das páginas
defined('MODULE_DIR') || define('MODULE_DIR', __DIR__ . '/modules/');

require_once (SYSTEM_DIR . 'config.php');
require_once (SYSTEM_DIR . 'function/BaseURI.php');
require_once (SYSTEM_DIR . 'function/UrlIndex.php');
require_once (SYSTEM_DIR . 'function/LoadModule.php');

$url = UrlIndex();
$baseUri = BaseURI();
?>
<html>
    <head>
        <base href="<?= $baseUri ?>" />
        <meta charset="<?= $config->charset ?>" />
        <title><?= SITE_NAME ?></title>

        <link href="lib/stylesheet/css-default.css" rel="stylesheet" type="text/css" />
        <link href="lib/stylesheet/sm-libary.css" rel="stylesheet" type="text/css" />
        <link href="lib/stylesheet/core.css" rel="stylesheet" type="text/css" />
        <link href="lib/stylesheet/media.css" rel="stylesheet" type="text/css" />
        
        <script src="lib/javascript/sm-libary.js" type="text/javascript"></script>
        <script src="lib/javascript/core.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        if ($url[0] === 'cadastro') {
            include (MODULE_DIR . 'user/new.php');
        } else if ($url[0] === 'confirmar') {
            include (MODULE_DIR . 'user/confirm.php');
        } else if ($url[0] === 'recuperar-senha') {
            include (MODULE_DIR . 'user/recover.php');
        } else if ($url[0] === 'entrar') {
            include (MODULE_DIR . 'user/login.php');
        } else {
            ?>
            <header><?php include (MODULE_DIR . 'default/header.php'); ?></header>
            <main><?php include (LoadModule($url[0])); ?></main>
            <footer>
                <?php include (MODULE_DIR . 'default/footer.php'); ?>
                <a href="inicio" class="href">inicio</a>
                <a href="administracao" class="href">administracao</a>
                <a href="app" class="href">app</a>
                <a href="doc" class="href">doc</a>
                <a href="comunidade" class="href">comunidade</a>
                <a href="perfil" class="href">perfil</a>
                <a href="mensagens" class="href">mensagens</a>
                <a href="notificacoes" class="href">notificacoes</a>
                <a href="sobre" class="href">sobre</a>
                <a href="termos" class="href">termos</a>
                <a href="privacidade" class="href">privacidade</a>
            </footer>
            <?php
        }
        ?>

        <!-- ELEMENTO DE AUXILIO DURANTE A FASE DE PRODUÇÃO -->
        <div id="dev-tg" style="position: fixed; left:50%; bottom:0; transform:translate(-50%,0%); padding: 10px 20px; background: black; color: white;">
            W: <div style="display: inline-block"></div> <span style="color:red">|</span>
            <?php
            foreach ($url as $key => $value) {
                echo ("url[{$key}] = {$value} <span style=\"color:red\">|</span> ");
            }
            ?>
            <a href="teste">TESTES DE PRODUÇÃO</a>
        </div>

        <script>
            var $itemOpen = new ItemOpen();

            var res = document.getElementById('dev-tg').children[0];
            res.innerText = window.innerWidth;
            window.onresize = function () {
                res.innerText = window.innerWidth;
            };
        </script>
    </body>
</html>
