# Criar um pequeno aplicativo passo a passo usando

- Composer
- PSR-4
- Namespace com autoload

Passos
- Criar a estrutura de diretórios
- Criar o composer.json com o autoload e PSR-4
- Digitar o namespace em cada uma das classes do namespace e somente nas classes
- Adicionar ao index.php do raiz:

require_once 'vendor/autoload.php';

Após concluir execute no raiz do aplicativo:
composer dumpautoload

Teste o aplicativo no navegador

Detalhando

Criar a pasta

/var/www/html/ns ou c:\xampp\htdocs\ns

Dentro criar

Para simplificar criarei apenas as classes controller e view
```php
src
    Controller
        ClientesController.php
    View	
	ClientesView.php		
index.php
composer.json
```

Definir o composer.json (bem simplificado)
```json
{
    "autoload": {
        "psr-4": {
            "Mvc\\": "src/;"
        }
    }
}
```

Temos o diretório src apontando para o namespace Mvc

Agora execute no diretório /var/www/html/ns

composer dumpautoload

Definindo as classes

Obs.: a linha com namespace ... deve ser a primeira linha do arquivo.

src/Controller/ClientesView.php
```php
<?php
namespace Mvc\View

class ClientesView
{
	public function index(){
		return 'View de Clientes';
	}
}
```
src/Controller/ClientesController.php
```php
<?php
// Veja que este controller está no diretório src/Controller, então em termos de namespace
namespace Mvc\Controller;

use Mvc\View\ClientesView;

class ClientesController
{
	public function index(){
		$view = new ClientesView();
		print $view->index();
	}
}
```
Definir o index.php do raiz
```php
<?php

require_once 'vendor/autoload.php';

use Mvc\Controller\ClientesController.php

$con = new ClientesController();
$con->index();
```
## Alerta: 
Eu perdi um bom tempo pesquisando sobre o erro de que ele não encontrava a classe.
Até que percebi que havia esquecido de criar o diretório src.
Cuidado com a estrutura de diretórios.

## Não mais includes/requires
Veja que se usa uma única vez para incluir o autoload.php

## Duas formas de chamar um método de classe com namespace
```php
use Tua\Classe;
$cls = new Classe();
$cls->metodo();
```
ou diretamente
```php
$cls = new \Tua\Classe();
$cls->metodo();
```
## Distinção entre classes locais e externas, do PHP usando \

\PDO

\Exception


