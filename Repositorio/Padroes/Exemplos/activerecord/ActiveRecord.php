<?php

/* Removi os campos create_at e update_at
 * Para que fique inteiramente genérico
 * Podendo ser utilizado com qualquer tabela
 */
abstract class ActiveRecord
{

    private static $connection;
    private $content;
    protected $table = NULL;
    protected $idField = NULL;

    public function __construct()
    {

        if ($this->table == NULL) {
            $this->table = strtolower(get_class($this));
        }
        if ($this->idField == NULL) {
            $this->idField = 'id';
        }
    }

    public function __set($parameter, $value)
    {
        $this->content[$parameter] = $value;
    }

    public function __get($parameter)
    {
        return $this->content[$parameter];
    }

    public function __isset($parameter)
    {
        return isset($this->content[$parameter]);
    }

    public function __unset($parameter)
    {
        if (isset($parameter)) {
            unset($this->content[$parameter]);
            return true;
        }
        return false;
    }

    private function __clone()
    {
        if (isset($this->content[$this->idField])) {
            unset($this->content[$this->idField]);
        }
    }

    public function toArray()
    {
        return $this->content;
    }

    public function fromArray(array $array)
    {
        $this->content = $array;
    }

    public function toJson()
    {
        return json_encode($this->content);
    }

    public function fromJson(string $json)
    {
        $this->content = json_decode($json);
    }

    private function format($value)
    {
        if (is_string($value) && !empty($value)) {
            return "'" . addslashes($value) . "'";
        } else if (is_bool($value)) {
            return $value ? 'TRUE' : 'FALSE';
        } else if ($value !== '') {
            return $value;
        } else {
            return "NULL";
        }
    }

    private function convertContent()
    {
        $newContent = array();
        foreach ($this->content as $key => $value) {
            if (is_scalar($value)) {
                $newContent[$key] = $this->format($value);
            }
        }
        return $newContent;
    }

    // Este método é destinado às operações insert e/ou update
    public function save()
    {
        $newContent = $this->convertContent();

        if (isset($this->content[$this->idField])) {

            $sets = array();
            foreach ($newContent as $key => $value) {
                if ($key === $this->idField)
                    continue;
                $sets[] = "{$key} = {$value}";
            }
            $sql = "UPDATE {$this->table} SET " . implode(', ', $sets) . " WHERE {$this->idField} = {$this->content[$this->idField]};";
        } else {
            $sql = "INSERT INTO {$this->table} (" . implode(', ', array_keys($newContent)) . ') VALUES (' . implode(',', array_values($newContent)) . ');';
        }
        if (self::$connection) {
            return self::$connection->exec($sql);
        } else {
            throw new Exception("Não há conexão com Banco de dados!");
        }
    }

    public static function find($parameter)
    {
        $class = get_called_class();
        $idField = (new $class())->idField;
        $table = (new $class())->table;

        $sql = 'SELECT * FROM ' . (is_null($table) ? strtolower($class) : $table);
        $sql .= ' WHERE ' . (is_null($idField) ? 'id' : $idField);
        $sql .= " = {$parameter} ;";

        if (self::$connection) {
            $result = self::$connection->query($sql);

            if ($result) {

                $newObject = $result->fetchObject(get_called_class());
            }

            return $newObject;
        } else {
            throw new Exception("Não há conexão com Banco de dados!");
        }
    }

    public function delete()
    {
        if (isset($this->content[$this->idField])) {

            $sql = "DELETE FROM {$this->table} WHERE {$this->idField} = {$this->content[$this->idField]};";

            if (self::$connection) {
                return self::$connection->exec($sql);
            } else {
                throw new Exception("Não há conexão com Banco de dados!");
            }
        }
    }

    public static function all(string $filter = '', int $limit = 0, int $offset = 0)
    {
        $class = get_called_class();
        $table = (new $class())->table;
        $sql = 'SELECT * FROM ' . (is_null($table) ? strtolower($class) : $table);
        $sql .= ($filter !== '') ? " WHERE {$filter}" : "";
        $sql .= ($limit > 0) ? " LIMIT {$limit}" : "";
        $sql .= ($offset > 0) ? " OFFSET {$offset}" : "";
        $sql .= ';';
        if (self::$connection) {
            $result = self::$connection->query($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, get_called_class());
        } else {
            throw new Exception("Não há conexão com Banco de dados!");
        }
    }

    public static function count(string $fieldName = '*', string $filter = '')
    {
        $class = get_called_class();
        $table = (new $class())->table;
        $sql = "SELECT count($fieldName) as t FROM " . (is_null($table) ? strtolower($class) : $table);
        $sql .= ($filter !== '') ? " WHERE {$filter}" : "";
        $sql .= ';';
        if (self::$connection) {
            $q = self::$connection->prepare($sql);
            $q->execute();
            $a = $q->fetch(PDO::FETCH_ASSOC);
            return (int) $a['t'];
        } else {
            throw new Exception("Não há conexão com Banco de dados!");
        }
    }

    public static function findFisrt(string $filter = '')
    {
        return self::all($filter, 1);
    }

    public static function setConnection(PDO $connection)
    {
        self::$connection = $connection;
    }
}
