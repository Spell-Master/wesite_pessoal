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
| @copyright: (c) 2022, Omar Pautz            |
| @version: 1.0 (14/07/2022)                  |
| @description: Registrar erros de execução   |
|  personalizados                             |
\*-------------------------------------------*/

class LogRegister {

    private static $file;
    private static $message;
    private static $comment;

    /**
     * ****************************************
     * Define os dados dos registros.
     * 
     * @param STR $file
     * Arquivo que está executando o método
     * @param STR $message
     * Mensagem de erro
     * @param STR $comment
     * Comentários adicionais
     * ****************************************
     */
    public static function dataError($file, $message, $comment = null) {
        self::$file = (string) $file;
        self::$message = (string) $message;
        self::$comment = (string) $comment;
        if (!empty($file) && !empty($message)) {
            self::registerError();
        }
    }

    /**
     * ****************************************
     * Registra o erro no banco de dados
     * ****************************************
     */
    private static function registerError() {
        $lgErr = new Select();
        $lgErr->query('log_error', [
            'lg_date' => date('Y-m-d'),
            'lg_hour' => date('H:i:s'),
            'lg_file' => self::$file,
            'lg_message' => htmlentities(self::$message),
            'lg_comment' => htmlentities(self::$comment)
        ]);
        if ($lgErr->error()) {
            self::sqlError();
        }
    }

    /**
     * ****************************************
     * Em caso de falha do resgistro no banco
     *  de dados escrever em arquivo de texto
     *  para averiguação posterior
     * ****************************************
     */
    private static function sqlError() {
        $txt = "== [ ERROR ] ===========================\n"
             . "- Data: " . date('Y-m-d') . "\n"
             . "- Horário: " . date('H:i:s') . "\n"
             . "- Arquivo: " . self::$file . "\n"
             . (!empty(self::$message) ? "- Mensagem:\n" . strip_tags(self::$message) . "\n" : "")
             . (!empty(self::$comment) ? "\n- Comentários:\n" . strip_tags(self::$comment) : "")
             . "\n";
        $reg = fopen(SYSTEM_DIR . 'error.log', 'a');
        fwrite($reg, $txt);
        fclose($reg);
    }
}

/*
 * TABELA PARA O BANCO DE DADOS
CREATE TABLE `log_error` (
    `lg_id` int(9) NOT NULL AUTO_INCREMENT,
    `lg_date` date COMMENT 'Data do erro',
    `lg_hour` time COMMENT 'Horário do erro',
    `lg_file` varchar(200) NOT NULL DEFAULT '' COMMENT 'Arquivo que gerou o erro',
    `lg_message` text NOT NULL DEFAULT '' COMMENT 'Mensagem de erro',
    `lg_comment` text NOT NULL DEFAULT '' COMMENT 'Comentários adicionais',
    PRIMARY KEY (`lg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 */
