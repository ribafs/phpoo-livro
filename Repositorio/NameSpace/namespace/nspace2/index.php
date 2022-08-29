<?php

require_once 'vendor/autoload.php';

use Nspace\Controller\ProdutosController;

$contr = new ProdutosController();

print $contr->index();
