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
| @copyright: (c) 2014, Omar Pautz            |
| @version: 6.5 (?/?/2017)                    |
| @description: Conexão PDO SingleTon         |
\*-------------------------------------------*/

class Connect {

    private static $host = DB_HOST;
    private static $user = DB_USER;
    private static $pass = DB_PASS;
    private static $data = DB_DATA;
    private static $isConnect = null;
    private static $isError = null;

    /**
     * ****************************************
     * Constroi a conexão
     * ****************************************
     */
    private static function makeConnect() {
        try {
            if (self::$isConnect == null) {
                $dsn = 'mysql:host=' . self::$host . '; dbname=' . self::$data;
                $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$isConnect = new PDO($dsn, self::$user, self::$pass, $options);
            }
        } catch (PDOException $e) {
            self::$isError = '<br>Não foi possível conectar com o banco de dados!<br> Descrição:' . $e->getMessage() . '<br>';
            //die('Erro interno no servidor. Código de referência 500');
            die($e->getMessage());
        }
        self::$isConnect->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return (self::$isConnect);
    }

    /**
     * ****************************************
     * Chama o construtor da conexão
     * ****************************************
     */
    protected static function callConnect() {
        return (self::makeConnect());
    }

    /**
     * ****************************************
     * Informa erros de conexão somente
     *  quando são disparados.
     * ****************************************
     */
    protected static function getError() {
        if (self::$isError) {
            return (self::$isError);
        }
    }

}
