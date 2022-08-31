<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/rotas/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/rotas/about' :
        require __DIR__ . '/views/about.php';
        break;
    default:
        require __DIR__ . '/views/index.php';
        break;
}
