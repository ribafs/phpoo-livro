<?php

// Conexão singleton simples
class Db {
    private static $connection=NULL;

    private function __construct (){}

    private $host='localhost';
    public $sgbd = 'mysql';
    public $db = 'testes';
    private $user = 'root';
    private $pass = 'root';

    public static function connect (){
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        self::$connection = new PDO($sgbd.':host='.$host.';dbname='.$db,$user, $pass, $pdo_options);

        return self::$connection;
    }
}
