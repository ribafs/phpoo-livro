# Namespace

Criar um aplicativo com estrutura MVC, dentro da pasta app
Aplicar o namespace com PSR-4 e composer
Explicando cada passo dado

Primeira fase usando apenas require, sem namespace, para se perceber a diferença

Esta fase usa namespace:
- Criei um composer.json
Com namespace 'Nspace' apontando para 'app'

Agora irei aplicar:
- namespace em cada classe
- E use onde não for classe

Quando terminar acessarei o diretório do aplicativo pelo terminal e executarei
composer dumpautoload

Em cada classe apliquei, logo no início:

namespace Nspace\Controller; // Para o caso do ProdutosController.php

Ainda no controller, logo abaixo do namespace:
namespace Nspace\Controller;
use Nspace\Model\ProdutosModel;
use Nspace\View\ProdutosView;

O único require é do autoload.php no index.php:
require_once 'vendor/autoload.php';

Logo abaixo:
use Nspace\Controller\ProdutosController;

