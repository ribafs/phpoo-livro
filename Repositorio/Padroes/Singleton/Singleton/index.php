<?php
include './Connection.php';

$con = connection::getInstance('./configdb.ini');

echo (is_a($con, PDO))?'Instanciado com êxito' :'Não deu certo!';