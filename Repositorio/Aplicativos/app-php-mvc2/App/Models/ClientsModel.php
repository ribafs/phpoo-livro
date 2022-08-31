<?php
declare(strict_types = 1);
namespace App\Models;

use Core\Model;

class ClientsModel extends Model
{ 

    private $table = '';

    /**
     * Onde o model é criado. Uma conexão com o banco de dados é aberta.
     */
    function __construct($table)
    {
        $this->table = $table;
        parent::__construct($this->table);
    }

    public function add($name, $email)
    {
        $sql = "INSERT INTO clients (name, email) VALUES (:name, :email)";
        $query = $this->pdo->prepare($sql);
        $parameters = array(":name" => $name, ":email" => $email);

        $query->execute($parameters);
    }

    public function umReg($field_id)
    {
        $sql = 'SELECT id, name, email FROM clients WHERE id = :field_id LIMIT 1';
        $query = $this->pdo->prepare($sql);
        $parameters = array(':field_id' => $field_id);

        $query->execute($parameters);

        // fetch() é o método PDO que recebe exatamento um único resultado/registro
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function update($name, $email, $field_id)
    {
        $sql = 'UPDATE clients SET name = :name, email = :email WHERE id = :field_id';
        $query = $this->pdo->prepare($sql);
        $parameters = array(':name' => $name, ':email' => $email, ':field_id' => $field_id);

        $query->execute($parameters);
    }
}
