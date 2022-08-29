<?php

class database
{
    public $dbh;
    private static $instance;

    private function __construct()
    {
        $this->dbh = new PDO('mysql:host=localhost;dbname=testes', "root", "root");
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }
}

// Testando
//get database connector by calling static method of database class [singleton pattern]
$db = database::getInstance();
 
        
//select operation
$sql = "select * from `clientes`";   //prepared statements
 
$query = $db -> dbh -> prepare($sql);         
                 
$result = $query -> fetchAll();

var_dump($result);

// https://acomputerengineer.com/2013/06/16/pdo-connection-class-in-php-oop-approach-with-singleton-pattern/
