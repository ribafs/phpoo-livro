<?php
declare(strict_types = 1);
namespace Core;

use PDO;
use PDOException;

class Connection
{ 

    // Como o PHP não permite ehrança múltipla então incorporei a classe Connection aui na Model
    public $pdo = null;

    /**
     * Onde o model é criado. Uma conexão com o banco de dados é aberta.
     */
    function __construct()
    {
        try {
            self::openDb();
        } catch ( PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Abrir a conexão com o banco de dados comm as credenciais de src/config.php
     */
    protected function openDb()
    {
        // Configurar (opcional) as opções para a conexão PDO. Neste caso, Nós configuramos o fetch mode para
        // "objects", o que significa que todos os resultados serão objetos, como este: $result->user_name !
        // Por exemplo, fetch mode FETCH_ASSOC deve retornar resultados como este: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

		// TODO - Criar uma classe singleton para o Model
        // Gerar uma conexão ao banco de dados, usando o conector PDO
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
		$dsn = DB_TYPE . ':host=' . DB_HOST . ';port ='. DB_PORT . ';dbname=' . DB_NAME;// . $databaseEncodingenc;
        try{
          $this->pdo = new PDO($dsn , DB_USER, DB_PASS, $options);
        }catch (PDOException $e){
          echo '<div align="center"><b>Mensagem: </b>'.$e->getMessage();
		  echo '<br><b>Código</b>: '.$e->getCode().'<br>';
		  echo '<b>Arquivo</b>: '.$e->getFile();
          echo '<br><b>Linha: </b>'.$e->getLine();
          die('<br><br><hr><h3>Crie o banco de dados<br>Importe o script "db_my.sql" existente no raiz<br>E tente conectar novamente<h3></div>');
        }
    }

}
