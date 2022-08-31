<?php
// diretório base da aplicação
define('BASE_PATH', dirname(__FILE__));
 
// credenciais de acesso ao MySQL
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', 'root');
define('MYSQL_DBNAME', 'testes');
 
// configurações do PHP
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set('America/Fortaleza');
