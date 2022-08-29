<?php

class DBManager
{
    private $selectables = array();
    private $table;
    private $whereClause;
    private $limit;

    public function select() {
        $this->selectables = func_get_args();
        return $this;
    }

    public function from($table) {
        $this->table = $table;
        return $this;
    }

    public function where($where) {
        $this->whereClause = $where;
        return $this;
    }

    public function limit($limit) {
        $this->limit = $limit;
        return $this;
    }

    public function result() {
        $query[] = "SELECT";
        // if the selectables array is empty, select all
        if (empty($this->selectables)) {
            $query[] = "*";  
        }
        // else select according to selectables
        else {
            $query[] = join(', ', $this->selectables);
        }

        $query[] = "FROM";
        $query[] = $this->table;

        if (!empty($this->whereClause)) {
            $query[] = "WHERE";
            $query[] = $this->whereClause;
        }

        if (!empty($this->limit)) {
            $query[] = "LIMIT";
            $query[] = $this->limit;
        }

        return join(' ', $query);
    }
}

$db = new DBManager();
$d = $db->select()->from('clientes')->where('id>30');

