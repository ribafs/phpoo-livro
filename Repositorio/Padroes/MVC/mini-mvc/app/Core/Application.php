<?php
/** Para mais informações sobre namespaces @veja http://php.net/manual/en/language.namespaces.importing.php */
namespace Mini\Core;

class Application
{
    /** @var null O controller */
    private $url_controller = null;

    /** @var null O método (do controller acima), também comumente chamado "action" */
    private $url_action = null;

    /** @var array URL parameters */
    private $url_params = array();

    /**
     * "Iniciar" a application:
     * Analise os elementos de URL e chame o controlador / método de acordo ou o fallback
     */
    public function __construct()
    {
        // criar um array com as partes da URL em $url
        $this->splitUrl();

        // verificar o controller: se nenhum controlador é fornecido então carregue a página inicial
        if (!$this->url_controller) {

            $page = new \Mini\Controller\HomeController();
            $page->index();

        } elseif (file_exists(APP . 'Controller/' . ucfirst($this->url_controller) . 'Controller.php')) {
            // aqui nós verificamos o controller: existe tal controller?

            // Em caso afirmativo, carregue este arquivo e crie este controller
            // como \Mini\Controller\CarController
            $controller = "\\Mini\\Controller\\" . ucfirst($this->url_controller) . 'Controller';
            $this->url_controller = new $controller();

            // verifique o método: existe um método desse tipo no controller ?
            if (method_exists($this->url_controller, $this->url_action) &&
                is_callable(array($this->url_controller, $this->url_action))) {
                
                if (!empty($this->url_params)) {
                    // Chame o método e passe argumentos para ele
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                } else {
                    // Se nenhum parâmetro for dado, basta chamar o método sem parâmetros, como $this->home->method();
                    $this->url_controller->{$this->url_action}();
                }

            } else {
                if (strlen($this->url_action) == 0) {
                    // nenhuma ação definida: chame o método index () padrão de um controller
                    $this->url_controller->index();
                } else {
                    $page = new \Mini\Controller\ErrorController();
                    $page->index();
                }
            }
        } else {
            $page = new \Mini\Controller\ErrorController();
            $page->index();
        }
    }

    /**
     * Obter e separar as partes da URL
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {

            // separar URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Coloque as partes da URL em propriedades de acordo
            // By the way, a sintaxe aqui é apenas uma forma abreviada de if / else, chamado "Operadores Ternários"
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;

            // Remover o controller e o action da URL dividida
            unset($url[0], $url[1]);

            // Rebase array keys e armazene os parâmetros da URL
            $this->url_params = array_values($url);

            // Para depuração. Descomente o código abaixo se você tiver problemas com o URL
            //echo 'Controller: ' . $this->url_controller . '<br>';
            //echo 'Action: ' . $this->url_action . '<br>';
            //echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
        }
    }
}
