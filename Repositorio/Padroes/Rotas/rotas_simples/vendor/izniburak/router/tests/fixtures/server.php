<?php

require __DIR__ . '/../../vendor/autoload.php';

use Buki\Router;

$params = [
    'paths' => [
        'controllers' => 'controllers/',
    ],
    'namespaces' => [
        'controllers' => 'Controllers\\',
    ],
    'base_folder' => __DIR__,
    'main_method' => 'main',
];

$router = new Router($params);

$router->get('/', function() {
    return 'Hello World!';
});

$router->get('/controllers', 'TestController@main');

$router->run();
