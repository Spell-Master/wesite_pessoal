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
| @description: Ler registros no banco de     |
|  dados                                      |
\*-------------------------------------------*/

class Select extends Connect {

    /** @Attr: Armazena a tabela */
    private $selectTable;

    /** @Attr: Armazena os valores */
    private $selectFields;

    /** @Attr: Armazena a syntax da query */
    private $selectSyntax;

    /** @Attr: Armazena a conexão */
    private $selectConn;

    /** @Attr: Armazena se houve sucesso na incerssão */
    private $selectData;

    /** @Attr: Armazena o erro para personalizar a saída */
    private $selectError;

    /**
     * ****************************************
     * Recebe os dados para ler.
     * 
     * @Param {STR} $table
     * Tabela para ler.
     * @Param {STR} $fields
     * Campos para ler.
     * @Param {STR} $statements
     * Valores para ler.
     * @see: (LIMIT/OFFSET) São opcionais.
     * ****************************************
     */
    public function query($table, $fields = null, $statements = null) {
        if (!empty($statements)) {
            parse_str($statements, $this->selectFields);
        }
        $this->selectTable = 'SELECT * FROM ' . $table . (isset($fields) ? ' WHERE ' . $fields : null);
        $this->selectExecute();
    }

    /**
     * ****************************************
     * Para leitura personalizada da query.
     * 
     * @Param {STR} $Query
     * Tabela para ler.
     * @Param {STR} $statements
     * Valores para ler.
     * @see : "LIMIT/OFFSET" São opcionais.
     * ****************************************
     */
    public function setQuery($Query, $statements = null) {
        if (!empty($statements)) {
            parse_str($statements, $this->selectFields);
        }
        $this->selectTable = (string) $Query;
        $this->selectExecute();
    }

    /**
     * ****************************************
     * Informa quantos resultados que foram
     *  encontrados.
     * 
     * @Return: (INT) Quantidade de registros
     * ****************************************
     */
    public function count() {
        return ($this->selectSyntax->rowCount());
    }

    /**
     * ****************************************
     * Informa os resultados que foram
     *  encontrados.
     * 
     * @Return: (ARRAY/BOLL)
     * ****************************************
     */
    public function result() {
        if ($this->selectData) {
            return ($this->selectData);
        }
    }

    /**
     * ****************************************
     * Informa erros de consulta.
     * 
     * @Return: (STRING/BOLL) Resultado
     *  a partir de PDOException
     * ****************************************
     */
    public function error() {
        if (!empty($this->selectError)) {
            return ($this->selectError);
        }
    }

    /**
     * ****************************************
     * Constroi a Syntax para query.
     * Altomaticamente detecta o uso de
     *  vinculos atribuitivos de resultado
     *  (LIMIT/OFFSET) e trata os mesmos como
     *  INTEGER.
     * ****************************************
     */
    private function selectConstruct() {
        if ($this->selectFields) {
            foreach ($this->selectFields as $type => $value) {
                if ($type == 'limit' || $type == 'offset') {
                    $value = (int) $value;
                }
                $this->selectSyntax->bindValue(":{$type}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }

    /**
     * ****************************************
     * Inicia a conexão e faz o
     * Prepare Statements.
     * ****************************************
     */
    private function selectConnect() {
        $this->selectConn = parent::callConnect();
        $this->selectSyntax = $this->selectConn->prepare($this->selectTable);
        $this->selectSyntax->setFetchMode(PDO::FETCH_OBJ);
    }

    /**
     * ****************************************
     * Executa os métodos e obtem os
     *  resultados.
     * 
     * @Return: (EXCEPTION) TRUE or FALSE
     * ****************************************
     */
    private function selectExecute() {
        $this->selectConnect();
        try {
            $this->selectConstruct();
            $this->selectSyntax->execute();
            $this->selectData = $this->selectSyntax->fetchAll();
        } catch (PDOException $error) {
            $this->selectData = null;
            $this->selectError = "Erro ao ler dados: {$error->getMessage()} {$error->getCode()}";
        }
    }
}
