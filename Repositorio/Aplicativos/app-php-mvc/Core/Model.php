<?php
declare(strict_types = 1);
namespace Core;

class Model extends Connection
{

    private $table = '';
    public $pdo = null;

    function __construct($table)
    {
        $this->table = $table;
        try {
            self::openDb();
        } catch ( PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    // Número de campos da tabela atual
    public function numFields(){
        $sql = 'SELECT * FROM '.$this->table.' LIMIT 1';
        $sth = $this->pdo->query($sql);
        $num_campos = $sth->columnCount();
        return $num_campos;
    }

    // Nome de campo pelo número $x
    public function fieldName($x){
        $sql = 'SELECT * FROM '.$this->table.' LIMIT 1';
        $sth = $this->pdo->query($sql);
        $meta = $sth->getColumnMeta($x);
        $field = $meta['name'];
        return $field;
    }

    public function fields(){
        $fld = '';
        for($x=1;$x < $this->numFields();$x++){
            $field = $this->fieldName($x);
            if($x < $this->numFields()-1){
              $fld .= $field.','; 
            }else{
              $fld .= $field; 
            }
		    }
        $fld = explode(',', $fld);
        return $fld;
    }

    public function class($sufix){
      $class = ucfirst($this->table).$sufix."('$this->table')";
      return $class;
    }    

    // Agora este três métodos abaixo não são criados sempre que se cria um novo crud, mas apenas herdados pelos novos models
    public function todosRegs()
    {
        $sql = 'SELECT * FROM '.$this->table.' ORDER BY id DESC';
//print $sql;exit;
        $query = $this->pdo->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function delete($field_id)
    {
        $sql = 'DELETE FROM '.$this->table.' WHERE id = :field_id';
        $query = $this->pdo->prepare($sql);
        $parameters = array(':field_id' => $field_id);

        $query->execute($parameters);
    }

    public function somaRegs()
    {
        $sql = 'SELECT COUNT(id) AS soma FROM '.$this->table;
        $query = $this->pdo->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->soma;
    }
}
