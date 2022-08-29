<?php

// inclui o autoloader do Composer 
require 'vendor/autoload.php'; 

// inclui o arquivo de inicialização 
require 'init.php'; 

// instancia o Slim, habilitando os erros (útil para debug, em desenvolvimento) 
$app = new \Slim\App([ 'settings' => [
        'displayErrorDetails' => true
    ]
]);
  
// página inicial
// listagem de usuários
$app->get('/', function ()
{
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->index();
});
 
// adição de usuário
// exibe o formulário de cadastro
$app->get('/add', function ()
{
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->create();
});
 
// processa o formulário de cadastro
$app->post('/add', function ()
{
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->store();
});
 
// edição de usuário
// exibe o formulário de edição
$app->get('/edit/{id}', function ($request)
{
    // pega o ID da URL
    $id = $request->getAttribute('id');
 
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->edit($id);
});
 
// processa o formulário de edição
$app->post('/edit', function ()
{
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->update();
});
 
// remove um usuário
$app->get('/remove/{id}', function ($request)
{
    // pega o ID da URL
    $id = $request->getAttribute('id');
 
    $UsersController = new \App\Controllers\UsersController;
    $UsersController->remove($id);
});
 
$app->run();
