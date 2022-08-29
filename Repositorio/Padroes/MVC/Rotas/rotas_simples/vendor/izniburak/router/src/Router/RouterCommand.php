<?php
/**
 * @ Package: Router - simple router class for php
 * @ Class: RouterCommand
 * @ Author: izni burak demirtas / @izniburak <info@burakdemirtas.org>
 * @ Web: http://burakdemirtas.org
 * @ URL: https://github.com/izniburak/php-router
 * @ Licence: The MIT License (MIT) - Copyright (c) - http://opensource.org/licenses/MIT
 */

namespace Buki\Router;

class RouterCommand
{
    /**
     * @var RouterCommand|null Class instance variable
     */
    protected static $instance = null;

    /**
     * Get class instance
     *
     * @return RouterCommand
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * Throw new Exception for Router Error
     *
     * @param $message
     *
     * @return RouterException
     * @throws
     */
    public function exception($message = '')
    {
        return new RouterException($message);
    }

    /**
     * Run Route Middlewares
     *
     * @param $command
     * @param $path
     * @param $namespace
     *
     * @return mixed|void
     * @throws
     */
    public function beforeAfter($command, $path = '', $namespace = '')
    {
        if (! is_null($command)) {
            if (is_array($command)) {
                foreach ($command as $key => $value) {
                    $this->beforeAfter($value, $path, $namespace);
                }
            } elseif (is_string($command)) {
                $controller = $this->resolveClass($command, $path, $namespace);
                if (method_exists($controller, 'handle')) {
                    return call_user_func([$controller, 'handle']);
                }

                return $this->exception('handle() method is not found in <b>'.$command.'</b> class.');
            }
        }

        return;
    }

    /**
     * Run Route Command; Controller or Closure
     *
     * @param $command
     * @param $params
     * @param $path
     * @param $namespace
     *
     * @return void
     * @throws
     */
    public function runRoute($command, $params = null, $path = '', $namespace = '')
    {
        if (! is_object($command)) {
			$segments = explode('@', $command);
			$controllerClass = str_replace([$namespace, '\\', '.'], ['', '/', '/'], $segments[0]);
			$controllerMethod = $segments[1];

            $controller = $this->resolveClass($controllerClass, $path, $namespace);
            if (method_exists($controller, $controllerMethod)) {
                echo call_user_func_array(
                    [$controller, $controllerMethod],
                    (!is_null($params) ? $params : [])
                );
                return;
            }

            return $this->exception($controllerMethod . ' method is not found in '.$controllerClass.' class.');
        } else {
            if (! is_null($params)) {
                echo call_user_func_array($command, $params);
                return;
            }

            echo call_user_func($command);
        }
    }

    /**
     * Resolve Controller or Middleware class.
     *
     * @param $class
     * @param $path
     * @param $namespace
     *
     * @return object
     * @throws
     */
    protected function resolveClass($class, $path, $namespace)
    {
        $file = realpath(rtrim($path, '/') . '/' . $class . '.php');
        if (! file_exists($file)) {
            return $this->exception($class . ' class is not found. Please, check file.');
        }

        require_once($file);
        $class = $namespace . str_replace('/', '\\', $class);

        return new $class();
    }
}
