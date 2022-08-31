<?php
/*
*
* @ Package: Router - simple router class for php
* @ Class: Router
* @ Author: izni burak demirtas / @izniburak <info@burakdemirtas.org>
* @ Web: http://burakdemirtas.org
* @ URL: https://github.com/izniburak/php-router
* @ Licence: The MIT License (MIT) - Copyright (c) - http://opensource.org/licenses/MIT
*
*/
namespace Buki;

use Closure;
use ReflectionMethod;
use Exception;
use Buki\Router\RouterRequest;
use Buki\Router\RouterCommand;
use Buki\Router\RouterException;

class Router
{
    /**
     * @var string $baseFolder Pattern definations for parameters of Route
     */
    protected $baseFolder;

    /**
     * @var array $routes Routes list
     */
    protected $routes = [];

    /**
     * @var array $groups List of group routes
     */
    protected $groups = [];

    /**
     * @var array $patterns Pattern definations for parameters of Route
     */
    protected $patterns = [
        '{a}' => '([^/]+)',
        '{d}' => '(\d+)',
        '{i}' => '(\d+)',
        '{s}' => '(\w+)',
        '{u}' => '([\w\-_]+)',
        '{*}' => '(.*)',
        ':id' => '(\d+)',
        ':number' => '(\d+)',
        ':any' => '([^/]+)',
        ':all' => '(.*)',
        ':string' => '(\w+)',
        ':slug' => '([\w\-_]+)',
    ];

    /**
     * @var array $namespaces Namespaces of Controllers and Middlewares files
     */
    protected $namespaces = [
        'middlewares' => '',
        'controllers' => ''
    ];

    /**
     * @var array $path Paths of Controllers and Middlewares files
     */
    protected $paths = [
        'controllers' => 'Controllers',
        'middlewares' => 'Middlewares'
    ];

    /**
     * @var string $mainMethod Main method for controller
     */
    protected $mainMethod = 'main';

    /**
     * @var string $mainMethod Cache file
     */
    protected $cacheFile = null;

    /**
     * @var bool $cacheLoaded Cache is loaded?
     */
    protected $cacheLoaded = false;

    /**
     * @var Closure $errorCallback Route error callback function
     */
    protected $errorCallback;

    /**
     * Router constructor method.
     *
     * @param array $params
     *
     * @return void
     */
    function __construct(array $params = [])
    {
        $this->baseFolder = realpath(getcwd());

        if (empty($params)) {
            return;
        }

        if (isset($params['debug']) && is_bool($params['debug'])) {
            RouterException::$debug = $params['debug'];
        }

        $this->setPaths($params);
        $this->loadCache();
    }

    /**
     * Set paths and namespaces for Controllers and Middlewares.
     *
     * @param array $params
     *
     * @return void
     */
    protected function setPaths($params)
    {
        if (isset($params['paths']) && $paths = $params['paths']) {
            $this->paths['controllers']	=
                isset($paths['controllers'])
                    ? trim($paths['controllers'], '/')
                    : $this->paths['controllers'];

            $this->paths['middlewares']	=
                isset($paths['middlewares'])
                    ? trim($paths['middlewares'], '/')
                    : $this->paths['middlewares'];
        }

        if (isset($params['namespaces']) && $namespaces = $params['namespaces']) {
            $this->namespaces['controllers'] =
                isset($namespaces['controllers'])
                    ? trim($namespaces['controllers'], '\\') . '\\'
                    : '';

            $this->namespaces['middlewares'] =
                isset($namespaces['middlewares'])
                    ? trim($namespaces['middlewares'], '\\') . '\\'
                    : '';
        }

        if (isset($params['base_folder'])) {
            $this->baseFolder = rtrim($params['base_folder'], '/');
        }

        if (isset($params['main_method'])) {
            $this->mainMethod = $params['main_method'];
        }

        if (isset($params['cache'])) {
            $this->cacheFile = $params['cache'];
        } else {
            $this->cacheFile = realpath(__DIR__ . '/../cache.php');
        }
    }

    /**
     * Add route method;
     * Get, Post, Put, Delete, Patch, Any, Ajax...
     *
     * @param $method
     * @param $params
     *
     * @return mixed
     * @throws
     */
    public function __call($method, $params)
    {
        if($this->cacheLoaded) {
            return true;
        }

        if (is_null($params)) {
            return false;
        }

        if (! in_array(strtoupper($method), explode('|', RouterRequest::$validMethods)) ) {
            return $this->exception($method . ' is not valid.');
        }

        $route = $params[0];
        $callback = $params[1];
        $settings = null;

        if (count($params) > 2) {
            $settings = $params[1];
            $callback = $params[2];
        }

        if (strstr($route, ':') || strstr($route, '{')) {
            $route1 = $route2 = '';
            foreach (explode('/', $route) as $key => $value) {
                if ($value != '') {
                    if (! strpos($value, '?')) {
                        $route1 .= '/' . $value;
                    } else {
                        if ($route2 == '') {
                            $this->addRoute($route1, $method, $callback, $settings);
                        }

                        $route2 = $route1 . '/' . str_replace('?', '', $value);
                        $this->addRoute($route2, $method, $callback, $settings);
                        $route1 = $route2;
                    }
                }
            }

            if ($route2 == '') {
                $this->addRoute($route1, $method, $callback, $settings);
            }
        } else {
            $this->addRoute($route, $method, $callback, $settings);
        }

        return true;
    }

    /**
     * Add new route method one or more http methods.
     *
     * @param string $methods
     * @param string $route
     * @param array|string|closure $settings
     * @param string|closure $callback
     *
     * @return bool
     */
    public function add($methods, $route, $settings, $callback = null)
    {
        if($this->cacheLoaded) {
            return true;
        }

        if (is_null($callback)) {
            $callback = $settings;
            $settings = null;
        }

        if (strstr($methods, '|')) {
            foreach (array_unique(explode('|', $methods)) as $method) {
                if ($method != '') {
                    call_user_func_array([$this, strtolower($method)], [$route, $settings, $callback]);
                }
            }
        } else {
            call_user_func_array([$this, strtolower($methods)], [$route, $settings, $callback]);
        }

        return true;
    }

    /**
     * Add new route rules pattern; String or Array
     *
     * @param string|array $pattern
     * @param null|string $attr
     *
     * @return mixed
     * @throws
     */
    public function pattern($pattern, $attr = null)
    {
        if (is_array($pattern)) {
            foreach ($pattern as $key => $value) {
                if (! in_array($key, array_keys($this->patterns))) {
                    $this->patterns[$key] = '(' . $value . ')';
                } else {
                    return $this->exception($key . ' pattern cannot be changed.');
                }
            }
        } else {
            if (! in_array($pattern, array_keys($this->patterns))) {
                $this->patterns[$pattern] = '(' . $attr . ')';
            } else {
                return $this->exception($pattern . ' pattern cannot be changed.');
            }
        }

        return true;
    }

    /**
     * Run Routes
     *
     * @return void
     * @throws
     */
    public function run()
    {
        $documentRoot = realpath($_SERVER['DOCUMENT_ROOT']);
        $getCwd = realpath(getcwd());

        $base = str_replace('\\', '/', str_replace($documentRoot, '', $getCwd) . '/');
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (($base !== $uri) && (substr($uri, -1) === '/')) {
            $uri = substr($uri, 0, (strlen($uri)-1));
        }

        if ($uri === '') {
            $uri = '/';
        }

        $method = RouterRequest::getRequestMethod();
        $searches = array_keys($this->patterns);
        $replaces = array_values($this->patterns);
        $foundRoute = false;

        $routes = [];
        foreach ($this->routes as $data) {
            array_push($routes, $data['route']);
        }

        // check if route is defined without regex
        if (in_array($uri, array_values($routes))) {
            foreach ($this->routes as $data) {
                if (RouterRequest::validMethod($data['method'], $method) && ($data['route'] === $uri)) {
                    $foundRoute = true;
                    $this->runRouteMiddleware($data, 'before');
                    $this->runRouteCommand($data['callback']);
                    $this->runRouteMiddleware($data, 'after');
                    break;
                }
            }
        } else {
            foreach ($this->routes as $data) {
                $route = $data['route'];

                if (strstr($route, ':') !== false || strpos($route, '{') !== false) {
                    $route = str_replace($searches, $replaces, $route);
                }

                if (preg_match('#^' . $route . '$#', $uri, $matched)) {
                    if (RouterRequest::validMethod($data['method'], $method)) {
                        $foundRoute = true;

                        $this->runRouteMiddleware($data, 'before');

                        array_shift($matched);
                        $newMatched = [];
                        foreach ($matched as $key => $value) {
                            if (strstr($value, '/')) {
                                foreach (explode('/', $value) as $k => $v) {
                                    $newMatched[] = trim(urldecode($v));
                                }
                            } else {
                                $newMatched[] = trim(urldecode($value));
                            }
                        }
                        $matched = $newMatched;

                        $this->runRouteCommand($data['callback'], $matched);
                        $this->runRouteMiddleware($data, 'after');
                        break;
                    }
                }
            }
        }

        // If it originally was a HEAD request, clean up after ourselves by emptying the output buffer
        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'HEAD') {
            ob_end_clean();
        }

        if ($foundRoute === false) {
            if (! $this->errorCallback) {
                $this->errorCallback = function() {
                    header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
                    return $this->exception('Route not found. Looks like something went wrong. Please try again.');
                };
            }
            call_user_func($this->errorCallback);
        }
    }

    /**
     * Routes Group
     *
     * @param string $name
     * @param closure|array $settings
     * @param null|closure $callback
     *
     * @return bool
     */
    public function group($name, $settings = null, $callback = null)
    {
        if($this->cacheLoaded) {
            return true;
        }

        $groupName = trim($name, '/');
        $group = [];
        $group['route'] = '/' . $groupName;
        $group['before'] = $group['after'] = null;

        if (is_null($callback)) {
            $callback = $settings;
        } else {
            $group['before'][] = (!isset($settings['before']) ? null : $settings['before']);
            $group['after'][]  = (!isset($settings['after']) ? null : $settings['after']);
        }

        $groupCount = count($this->groups);
        if ($groupCount > 0) {
            $list = [];
            foreach ($this->groups as $key => $value) {
                if (is_array($value['before'])) {
                    foreach ($value['before'] as $k => $v) {
                        $list['before'][] = $v;
                    }
                    foreach ($value['after'] as $k => $v) {
                        $list['after'][] = $v;
                    }
                }
            }

            if (! is_null($group['before'])) {
                $list['before'][] = $group['before'][0];
            }

            if (! is_null($group['after'])) {
                $list['after'][] = $group['after'][0];
            }

            $group['before'] = $list['before'];
            $group['after'] = $list['after'];
        }

        $group['before'] = array_values(array_unique( (array) $group['before']));
        $group['after'] = array_values(array_unique( (array) $group['after']));

        array_push($this->groups, $group);

        if (is_object($callback)) {
            call_user_func_array($callback, [$this]);
        }

        $this->endGroup();

        return true;
    }

    /**
     * Added route from methods of Controller file.
     *
     * @param string $route
     * @param string|array $settings
     * @param null|string $controller
     *
     * @return mixed
     * @throws
     */
    public function controller($route, $settings, $controller = null)
    {
        if($this->cacheLoaded) {
            return true;
        }

        if (is_null($controller)) {
            $controller = $settings;
            $settings = [];
        }

        $controller = str_replace(['\\', '.'], '/', $controller);
        $controller = trim(
            preg_replace(
                '/'.str_replace('/', '\\/', $this->paths['controllers']).'/i',
                '', $controller,
                1
            ),
            '/'
        );
        $controllerFile = realpath(
            rtrim($this->paths['controllers'], '/') . '/' . $controller . '.php'
        );

        if (! file_exists($controllerFile)) {
            return $this->exception($controller . ' class is not found!');
        }

        if (! class_exists($controller)) {
            require $controllerFile;
        }

        $controller = str_replace('/', '\\', $controller);
        $classMethods = get_class_methods($this->namespaces['controllers'] . $controller);
        if ($classMethods) {
            foreach ($classMethods as $methodName) {
                if(!strstr($methodName, '__')) {
                    $method = "any";
                    foreach(explode('|', RouterRequest::$validMethods) as $m) {
                        if(stripos($methodName, strtolower($m), 0) === 0) {
                            $method = strtolower($m);
                            break;
                        }
                    }

                    $methodVar = lcfirst(preg_replace('/'.$method.'/i', '', $methodName, 1));
                    $methodVar = strtolower(preg_replace('%([a-z]|[0-9])([A-Z])%', '\1-\2', $methodVar));
                    $r = new ReflectionMethod($this->namespaces['controllers'] . $controller, $methodName);
                    $reqiredParam = $r->getNumberOfRequiredParameters();
                    $totalParam = $r->getNumberOfParameters();

                    $value = ($methodVar === $this->mainMethod ? $route : $route.'/'.$methodVar);
                    $this->{$method}(
                        ($value.str_repeat('/:any', $reqiredParam).str_repeat('/:any?', $totalParam-$reqiredParam)),
                        $settings,
                        ($controller . '@' . $methodName)
                    );
                }
            }
            unset($r);
        }

        return true;
    }

    /**
     * Routes error function. (Closure)
     *
     * @param $callback
     *
     * @return void
     */
    public function error($callback)
    {
        $this->errorCallback = $callback;
    }

    /**
     * Add new Route and it's settings
     *
     * @param $uri
     * @param $method
     * @param $callback
     * @param $settings
     *
     * @return void
     */
    private function addRoute($uri, $method, $callback, $settings)
    {
        $groupItem = count($this->groups) - 1;
        $group = '';
        if ($groupItem > -1) {
            foreach ($this->groups as $key => $value) {
                $group .= $value['route'];
            }
        }

        $page = dirname($_SERVER['PHP_SELF']);
        $page = $page === '/' ? '' : $page;
        if (strstr($page, 'index.php')) {
            $data = implode('/', explode('/', $page));
            $page = str_replace($data, '', $page);
        }

        $route = $page . $group . '/' . trim($uri, '/');
        $route = rtrim($route, '/');
        if ($route === $page) {
            $route .= '/';
        }

        $data = [
            'route' => str_replace('//', '/', $route),
            'method' => strtoupper($method),
            'callback' => $callback,
            'name' => (isset($settings['name'])
                ? $settings['name']
                : null
            ),
            'before' => (isset($settings['before'])
                ? $settings['before']
                : null
            ),
            'after' => (isset($settings['after'])
                ? $settings['after']
                : null
            ),
            'group' => ($groupItem === -1) ? null : $this->groups[$groupItem]
        ];
        array_push($this->routes, $data);
    }

    /**
     * Run Route Command; Controller or Closure
     *
     * @param $command
     * @param $params
     * @return null
     */
    private function runRouteCommand($command, $params = null)
    {
        $this->routerCommand()->runRoute(
            $command,
            $params,
            $this->baseFolder . '/' . $this->paths['controllers'],
            $this->namespaces['controllers']
        );
    }

    /**
     * Detect Routes Middleware; before or after
     *
     * @param $middleware
     * @param $type
     *
     * @return void
     */
    public function runRouteMiddleware($middleware, $type)
    {
        $middlewarePath = $this->baseFolder . '/' . $this->paths['middlewares'];
        $middlewareNs = $this->namespaces['middlewares'];
        if ($type == 'before') {
            if (! is_null($middleware['group'])) {
                $this->routerCommand()->beforeAfter(
                    $middleware['group'][$type], $middlewarePath, $middlewareNs
                );
            }
            $this->routerCommand()->beforeAfter(
                $middleware[$type], $middlewarePath, $middlewareNs
            );
        } else {
            $this->routerCommand()->beforeAfter(
                $middleware[$type], $middlewarePath, $middlewareNs
            );
            if (! is_null($middleware['group'])) {
                $this->routerCommand()->beforeAfter(
                    $middleware['group'][$type], $middlewarePath, $middlewareNs
                );
            }
        }
    }

    /**
     * Routes Group endpoint
     *
     * @return void
     */
    private function endGroup()
    {
        array_pop($this->groups);
    }

    /**
     * Display all Routes.
     *
     * @return void
     */
    public function getList()
    {
        echo '<pre style="font-size:15px;">';
        var_dump($this->getRoutes());
        echo '</pre>';
        die;
    }

    /**
     * Get all Routes
     *
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
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
     * RouterCommand class
     *
     * @return RouterCommand
     */
    public function routerCommand()
    {
        return RouterCommand::getInstance();
    }

    /**
     * Cache all routes
     *
     * @return bool
     * @throws Exception
     */
    public function cache()
    {
        foreach($this->getRoutes() as $key => $r) {
            if (!is_string($r['callback'])) {
                throw new Exception(sprintf('Routes cannot contain a Closure/Function callback while caching.'));
            }
        }

        $cacheContent = '<?php return '.var_export($this->getRoutes(), true).';' . PHP_EOL;
        if (false === file_put_contents($this->cacheFile, $cacheContent)) {
            throw new Exception(sprintf('Routes cache file could not be written.'));
        }

        return true;
    }

    /**
     * Load Cache file
     *
     * @return bool
     */
    protected function loadCache()
    {
        if (file_exists($this->cacheFile)) {
            $this->routes = require $this->cacheFile;
            $this->cacheLoaded = true;
            return true;
        }

        return false;
    }
}
