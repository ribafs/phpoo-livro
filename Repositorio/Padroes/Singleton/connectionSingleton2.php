<?php

class Connection {

    protected static $instance;
    private static $dsn = 'mysql:host=localhost;dbname=testes';
    private static $username = 'root';
    private static $password = 'root';

    private function __construct() {
        try {
            self::$instance = new PDO(self::$dsn, self::$username, self::$password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
       			self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            new Connection();
        }

        return self::$instance;
    }

}

// Testando
// some previous code...
$conn = Connection::getInstance();
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
?>
