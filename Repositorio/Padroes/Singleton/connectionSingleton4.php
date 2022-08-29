<?php
 
class Conexao {
 
    public static $instance;
 
    private function __construct() {
        //
    }
 
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=localhost;dbname=testes', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));            
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
       			self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }
 
        return self::$instance;
    }
 
}

$conn = Conexao::getInstance();

$query = "SELECT * FROM clientes";

$statement = $conn->prepare($query);
$statement->execute();

$result = $statement->fetchAll();
print '<table>';
print '<tr><td>ID</td><td>Nome</td><td>E-mail</td></tr>';
foreach($result as $rr){
print '<tr><td>'.$rr->id.'</td><td>'.$rr->nome.'</td><td>'.$rr->email.'</td></tr>';
}
print '</table>';
// some next code...

// https://www.devmedia.com.br/php-singleton-aplicando-o-padrao-de-projeto-na-pratica/28469
