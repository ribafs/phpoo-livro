<?php

require 'app/Controller/ProdutosController.php';

$contr = new ProdutosController();

print $contr->index();
