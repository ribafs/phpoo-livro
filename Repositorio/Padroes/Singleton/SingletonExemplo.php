<?php
// Exemplo prático de uso do padrão Singleton
class Connection {

    protected static $instance;
    private static $dsn = 'mysql:host=localhost;dbname=testes';
    private static $username = 'root';
    private static $password = 'root';

    private function __construct() {
        try {
            self::$instance = new PDO(self::$dsn, self::$username, self::$password);
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

?>

<?php

$connection = Connection::getInstance();
$query = "SELECT * FROM users";

$statement = $connection->prepare($query);
$statement->bindValue('id', $id, \PDO::PARAM_INT);
$statement->execute();

$result = $statement->fetchAll();
foreach($result as $user){
    print $user['login'].'<br>';
}
// some next code...
?>
