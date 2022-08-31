<?php
declare(strict_types = 1);
namespace App\Models;

use Core\Model;

class ProductsModel extends Model
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

    public function add($name, $price)
    {
        $sql = "INSERT INTO products (name, price) VALUES (:name, :price)";
        $query = $this->pdo->prepare($sql);
        $parameters = array(":name" => $name, ":price" => $price);

        $query->execute($parameters);
    }

    public function umReg($field_id)
    {
        $sql = 'SELECT id, name, price FROM products WHERE id = :field_id LIMIT 1';
        $query = $this->pdo->prepare($sql);
        $parameters = array(':field_id' => $field_id);

        $query->execute($parameters);

        // fetch() é o método PDO que recebe exatamento um único resultado/registro
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function update($name, $price, $field_id)
    {
        $sql = 'UPDATE products SET name = :name, price = :price WHERE id = :field_id';
        $query = $this->pdo->prepare($sql);
        $parameters = array(':name' => $name, ':price' => $price, ':field_id' => $field_id);

        $query->execute($parameters);
    }
}
