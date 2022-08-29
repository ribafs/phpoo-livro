<?php

// Singleton to connect db.
class ConnectDb {
  // Hold the class instance. Tudo private
  private static $instance = null;
  private $conn;
  
  private $host = 'localhost';
  private $user = 'root';
  private $pass = 'root';
  private $name = 'testes';
   
  // Construtor private para que ninguém possa instanciar
  private function __construct()
  {
    $this->conn = new PDO("mysql:host={$this->host};
    dbname={$this->name}", $this->user,$this->pass,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
  }
  
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new ConnectDb();
    }
   
    return self::$instance;
  }
  
  public function getConnection()
  {
    return $this->conn;
  }
}

// Testando

$instance = ConnectDb::getInstance();// Este é static
$conn = $instance->getConnection(); // Este não é static

$stmte = $conn->query("SELECT * FROM clientes order by nome");
$executa = $stmte->execute();
$reg = $stmte->fetchAll(PDO::FETCH_OBJ);

print '<table>';
print '<tr><td>ID</td><td>Nome</td><td>E-mail</td></tr>';
foreach($reg as $rr){
print '<tr><td>'.$rr->id.'</td><td>'.$rr->nome.'</td><td>'.$rr->email.'</td></tr>';
}
print '</table>';

//Referência
//https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
