<?php

return [
    'ready' => true, // Indica que o arquivo foi carregado com sucesso

    /*
     * Conexão com o banco de dados 
     */
    'dbHost' => 'localhost', // Endereço do banco de dados
    'dbUser' => 'root', // Usuário do banco de dados
    'dbPass' => '', // Senha do banco de dados
    'dbName' => 'sitepessoal', // Nome do banco de dados

    /*
     * Conexão SMTP
     */
    'mailHost' => '', // Endereço de acesso ao servidor SMTP
    'mailUser' => '', // Endereço do usuário do servidor SMTP
    'mailPass' => '', // Senha do usuário do servidor SMTP
    'mailType' => 'tls', // Tipo de criptografia de acesso do servidor SMTP (tls/sll)
    'mailPort' => 587, // Porta de acesso ao servidor SMTP
    'mailChar' => 'urf-8', // Charset de codificação para os e-mails.
];
