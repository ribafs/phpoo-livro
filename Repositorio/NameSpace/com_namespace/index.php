<?php

// https://www.youtube.com/watch?v=o2CXLk74ggE

require 'classes/produto.php';
require 'models/produto.php';

// Com namespaces

$produto = new \models\Produto();
//$produto = new \classes\Produto();
$produto->mostrarDetalhes();

