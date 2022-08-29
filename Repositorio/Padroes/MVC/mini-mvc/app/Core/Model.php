<?php

namespace Mini\Core;

use PDO;

class Model
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * Sempre que o modelo for criado, abra uma conexão com o banco de dados.
     */
    function __construct()
    {
        try {
            self::openDatabaseConnection();
        } catch (\PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Abra a conexão com o banco de dados com as credenciais para application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // defina as opções da conexão PDO. Neste caso, definimos o modo de busca para
        // "objects", o que significa que todos os resultados serão objetos, como este: $result->user_name !
        // Por exemplo, fetch mode FETCH_ASSOC retornaria resultados como este: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        
        // definindo a codificação é diferente ao usar PostgreSQL
        if (DB_TYPE == "pgsql") {
            $databaseEncodingenc = " options='--client_encoding=" . DB_CHARSET . "'";
        } else {
            $databaseEncodingenc = "; charset=" . DB_CHARSET;
        }

        // gerar uma conexão de banco de dados, usando o conector PDO
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . $databaseEncodingenc, DB_USER, DB_PASS, $options);
    }
}
