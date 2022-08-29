<?php

class Conexao
{
    private static $conexao;

    private function __construct()
    {}

    public static function getInstance()
    {
        if (is_null(self::$conexao)) {
            self::$conexao = new \PDO('mysql:host=localhost;port=3306;dbname=projeto_mvc', 'root', '123456');
            self::$conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$conexao->exec('set names utf8');
        }
        return self::$conexao;
    }
}
