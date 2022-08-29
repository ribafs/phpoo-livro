<?php
// Pego todo o caminho da nossa aplicação apartir do servidor. 
// Exemplo: se eu tenho um endereço http://localhost/aqui/eonosso/caminho , com o REQUEST_URI eu vou pegar /aqui/eonosso/caminho.
$url = $_SERVER["REQUEST_URI"];

// retiro a parte que não é interessante pra mim, no caso aqui/eonosso/caminho, que eu tenho que acessar antes, até chegar na minha aplicação. 
$url = str_replace("/sergio/exemplos/mvc/", "", $url);

// tiro todas as barras encontradas no endereço e monto um array a partir de cada barra tirada, e armazeno na variável $op. 
$op = explode("/", $url);
 
if ( $op[0] )
{
    include ("../application/controllers/" . $op[0] . ".php");
    $obj = new $op[0] ();
}
else
{
    include ("../application/controllers/ola.php");
    $obj = new Ola();
}
 
if ( $op[1] == "" )
{
    $obj->index();
}
else
{
    $obj-> $op[1] ( $op[2] );
}

