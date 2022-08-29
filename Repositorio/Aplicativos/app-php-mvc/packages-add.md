# How to add third party packages

## Package to migrations - phinx and faker

Installation

composer require robmorgan/phinx
composer require fzaninotto/faker

Gererate phinx.yml - database configurations

Create on application root:

- mkdir db
- mkdir db/migrations
- mkdir db/seeds

Execute

Linux
php vendor/bin/phinx init

Windows
php vendor\bin\phinx.bat init

Edite phinx.yml and adjust database configuration.

Create migrations

Linux
vendor/robmorgan/phinx/bin/phinx create Customers

Windows
vendor\robmorgan\phinx\bin\phinx.bat create Customers

Edit db/migrations/20190821114033_customers.php

Adapte change method to:
```php
public function change()
{
		$this->table('customers')
		    ->addColumn('name', 'string', ['limit' => 50])
		    ->addColumn('email', 'string', ['limit' => 50])
		    ->addColumn('birthday', 'date', ['null' => true])
		    ->addColumn('created', 'datetime',['default'=>'CURRENT_TIMESTAMP'])
		    ->create();
}
```
Execute to create table

php vendor/robmorgan/phinx/bin/phinx migrate -e development

Windows
php vendor\robmorgan\phinx\bin\phinx migrate -e development

Create seeds

Linux
php vendor/bin/phinx seed:create Customers

Windows (não funcionou)
php vendor/bin/phinx seed:create Customers

Edit generated db/seeds/Customers.php
```php
class Customers extends AbstractSeed
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'name'      => $faker->userName,
                'email'         => $faker->email,
                'birthday'    => $faker->date('Y-m-d'),
                'created'       => date('Y-m-d H:i:s'),
            ];
        }

        $this->insert('customers', $data);
    }
}
```
Execute to populate table

php vendor/bin/phinx seed:run -e development

## Tracy
composer require tracy/tracy

<?php
require_once 'vendor/autoload.php';

use Tracy\Debugger;

Debugger::enable();

//Mostrar a barra de debug
Debugger::$showBar = true;

https://github.com/nette/tracy


## Error Handler with Whoops

Install

composer require filp/whoops

Configurations to use Whoops:
- Create two development environments using define on config/config.php
- Basic configurations to Whoops on application/bootstrap.php (below)
- If in development environment woops display your error windows


## src/bootstrap.php with whoops suport:
```php
<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'src' . DIRECTORY_SEPARATOR);
require_once ROOT . 'vendor/autoload.php';
require_once APP . 'config/config.php';

/**
* Register the error handler
*/
$whoops = new \Whoops\Run;

if (ENVIRONMENT !== 'production') {
// Configure the PrettyPageHandler:
$errorPage = new Whoops\Handler\PrettyPageHandler();
 
$errorPage->setPageTitle("Also wrong here!"); // Set the page's title
$errorPage->setEditor("sublime");         // Set the editor used for the "Open" link
// Algumas informações extras
$errorPage->addDataTable("Extra Informations", array(
      "stuff"     => 123,
      "foo"       => "bar",
      "useful_id" => "baloney"
));
} else {
    $whoops->pushHandler(function($e){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
 
$whoops->pushHandler($errorPage);
$whoops->register();
 
// Uncomment the line below to use Whoops
//throw new RuntimeException("Verify details!");
// load application class
use Mvc\Core\Router;

// start the application
$app = new Router();
```

## References:
https://code.tutsplus.com/tutorials/whoops-php-errors-for-cool-kids--net-32344
https://github.com/ribafs/no-framework-tutorial


