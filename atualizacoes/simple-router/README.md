# simple-router

https://dev.to/shoaiyb/building-a-php-routing-system-54g5

Um exemplo bem simples de classe de rotas.

O autor sugere o uso do servidor web nativo do PHP.
Com ele funciona, mas usando o Apache não funcionou.
Então fiz uma rápida pesquisa e coloquei o .htaccess da pasta public do nosso aplicativo app-php-mvc e funcionou.
Lembrando que esse arquivo redireciona tudo para o index.php de public.

Originalmente veio com

/**
 * Add a "hello" route that prints to the screen.
 */
$router->addRoute('hello', function() {
    echo 'Well, hello there!!';
});

http://localhost:1234/hello


Então adicionei esta:

$router->addRoute('ola', function() {
    echo 'Como vai?!!';
});


Resolvi criar a pasta views com duas subpastas, com index.php
E chamei assim

$router->addRoute('clients', function() {
    require 'views/clients/index.php';
});

$router->addRoute('products', function() {
    require 'views/products/index.php';
});


Então tentei adaptar para o nosso aplicativo, substituir o Core/Router.php por este index.php.
Fiz alguns ajustes mas não consegui, ao chamar /clients a tela fica em branco.


