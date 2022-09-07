<?php
declare(strict_types = 1);
namespace App\Models;

use Core\Connection;

class ClientsModel extends Connection
{ 
    public function add($name, $email)
    {
        $sql = "INSERT INTO clients (name, email) VALUES (:name, :email)";
        $query = $this->pdo->prepare($sql);
        $parameters = array(":name" => $name, ":email" => $email);

        $query->execute($parameters);
    }

    public function oneReg($field_id)
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
    
    public function delete($field_id)
    {
        $sql = 'DELETE FROM clients WHERE id = :field_id';
        $query = $this->pdo->prepare($sql);
        $parameters = array(':field_id' => $field_id);
        $query->execute($parameters);
    }    

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see App/Controllers/ClientController.php for more)
     */
    public function allRegs()
    {
        $sql = "SELECT * FROM clients ORDER BY id DESC";
        $query = $this->pdo->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll();
    }
    
}
