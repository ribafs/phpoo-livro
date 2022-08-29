<?php

// https://www.youtube.com/watch?v=o2CXLk74ggE

require 'classes/produto.php';
require 'models/produto.php';

//Testando sem namespace
$produto = new Produto();

//Acusará o erro:
//Fatal error: Cannot declare class Produto, because the name is already in use in /backup/www/namespace/models/produto.php on line 3

