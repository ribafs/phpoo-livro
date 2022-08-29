<?php
require_once __DIR__.'/../vendor/autoload.php';

use App\Router;
$app = new Router();

$app->get('/', function () {
    return \App\Controller\AppController::index();
});

$app->get('/list', function () {
    return \App\Controller\AppController::list();
});

$app->post('/list', function () {
    return \App\Controller\AppController::write();
});

$app->get('/out', function () {
    return \App\Controller\AppController::logout();
});

$app->run();