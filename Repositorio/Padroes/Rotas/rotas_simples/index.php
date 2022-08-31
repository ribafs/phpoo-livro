<?php
require 'vendor/autoload.php';

$router = new Buki\Router();

$router->get('/', function() {
    return 'Hello World!';
});

$router->get('/contato', function() {
    return 'Contato!';
});

$router->get('/sobre', function() {
    return 'Sobre Mim!';
});

$router->get('/controller', 'TestController@main');

$router->run();
