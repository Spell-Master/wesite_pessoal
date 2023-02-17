<!DOCTYPE html>
<?php
// Diretório para sistemas
defined('SYSTEM_DIR') || define('SYSTEM_DIR', __DIR__ . '/system/');

// Diretório das páginas
defined('PAGE_DIR') || define('PAGE_DIR', __DIR__ . '/pages/');

require_once (SYSTEM_DIR . 'config.php');
require_once (SYSTEM_DIR . 'function/BaseURI.php');
require_once (SYSTEM_DIR . 'function/UrlIndex.php');
require_once (SYSTEM_DIR . 'function/LoadPage.php');

$url = UrlIndex();
$baseUri = BaseURI();
?>
<html>
    <head>
        <base href="<?= $baseUri ?>">
        <meta charset="<?= $config->charset ?>">
        <title><?= $config->siteName ?></title>
    </head>
    <body>
        <?php
        if ($url[0] === 'cadastro') {
            include (PAGE_DIR . 'user/new.php');
        } else if ($url[0] === 'confirmar') {
            include (PAGE_DIR . 'user/confirm.php');
        } else if ($url[0] === 'recuperar-senha') {
            include (PAGE_DIR . 'user/recover.php');
        } else if ($url[0] === 'entrar') {
            include (PAGE_DIR . 'user/login.php');
        } else {
            ?>
            <header><?php include (PAGE_DIR . 'default/header.php'); ?></header>
            <main><?php include (LoadPage($url[0])); ?></main>
            <footer>
                <?php include (PAGE_DIR . 'default/footer.php'); ?>
                <a href="inicio">inicio</a>
                <a href="administracao">administracao</a>
                <a href="app">app</a>
                <a href="perfil">perfil</a>
                <a href="mensagens">mensagens</a>
                <a href="sobre">sobre</a>
                <a href="termos">termos</a>
                <a href="privacidade">privacidade</a>
                <a href="doc">doc</a>
                <a href="comunidade">comunidade</a>
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
