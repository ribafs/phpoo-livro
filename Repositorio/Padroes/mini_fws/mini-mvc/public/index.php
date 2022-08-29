<?php

/**
 * MINI - um aplicativo em PHP cru e extremamente simples
 *
 * @package mini
 * @author Panique
 * @link http://www.php-mini.com
 * @link https://github.com/panique/mini/
 * @license http://opensource.org/licenses/MIT MIT License
 */

/**
 * Agora MINI trablaha com namespaces + composer's autoloader (PSR-4)
 *
 * @author Joao Vitor Dias <joaodias@noctus.org>
 *
 * Para mais informações sobre namespaces @see http://php.net/manual/en/language.namespaces.importing.php
 */

// definir uma constante que mantenha o caminho da pasta do projeto, como "/var/www/html/".
// DIRECTORY_SEPARATOR adiciona uma para o final do path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// definir uma constante que mantém a pasta "application" do projeto, como "/var/www/html/projeto/application".
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);

// Este é o auto-loader para dependências do Composer (para carregar ferramentas em seu projeto).
require ROOT . 'vendor/autoload.php';

// carregar configuração do aplicativo (error reporting etc.)
require APP . 'config/config.php';

// carregar a classe application
use Mini\Core\Application;

// iniciar a app
$app = new Application();
