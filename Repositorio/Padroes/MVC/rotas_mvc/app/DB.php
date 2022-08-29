<?php
 
namespace app;
 
class DB extends \PDO
{
    public function __construct($dsn = null, $username = null, $password = null, $options = array())
    {
        $dsn = ($dsn != null) ? $dsn : sprintf('mysql:dbname=%s;host=%s', MYSQL_DBNAME, MYSQL_HOST);
        $username = ($username != null) ? $username : MYSQL_USER;
        $password = ($password != null) ? $password : MYSQL_PASS;
         
        parent::__construct($dsn, $username, $password, $options);
    }
}
